USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[jumlah_total]    Script Date: 07/17/2024 08:08:58 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER OFF
GO
ALTER PROCEDURE [dbo].[SP_GetTotalGabungan_DGM]
@tahun VARCHAR(4),
@bulan VARCHAR(100)
AS

BEGIN 
IF EXISTS(SELECT [Table_name] FROM tempdb.information_schema.tables WHERE [Table_name] like '#temptess') 
    BEGIN
      DROP TABLE #temptess;
    END;
  
IF EXISTS(SELECT [Table_name] FROM tempdb.information_schema.tables WHERE [Table_name] like '#temptess2') 
    BEGIN
      DROP TABLE #temptess2;
    END;  

CREATE TABLE #temptess(
    id int NOT NULL identity(1,1),
    nama_toko VARCHAR(150),
    bulan VARCHAR(150),
    tahun VARCHAR(150),
    w1 FLOAT DEFAULT 0,
    w2 FLOAT DEFAULT 0,
    w3 FLOAT DEFAULT 0,
    w4 FLOAT DEFAULT 0,
    l0 FLOAT DEFAULT 0,
    l1 FLOAT DEFAULT 0,
    l2 FLOAT DEFAULT 0,
    l3 FLOAT DEFAULT 0,
    l4 FLOAT DEFAULT 0,
	total float DEFAULT 0,
	target float DEFAULT 0,
	ach float DEFAULT 0,
	growth float DEFAULT 0,
	lt float DEFAULT 0,
	ml1 float DEFAULT 0,
	ml2 float DEFAULT 0,
	ml3 float DEFAULT 0,
	ml4 float DEFAULT 0,
    fml float DEFAULT 0,
	subtotalmax float
)

    
	DECLARE @w1 float;
	DECLARE @w2 float;
	DECLARE @w3 float;
	DECLARE @w4 float; 
	DECLARE @l0 float; 
	DECLARE @l1 float; 
	DECLARE @l2 float; 
	DECLARE @l3 float; 
	DECLARE @l4 float;
	DECLARE @ml1 float;
	DECLARE @ml2 float;
	DECLARE @ml3 float;
	DECLARE @ml4 float;
	DECLARE @total float;
	DECLARE @target float;
	DECLARE @ach float;
	DECLARE @growth float;
	DECLARE @fml float;
	DECLARE @subtotalmax float;
	DECLARE @list float;
	DECLARE @lt float;
	
 SET @w1 = (SELECT SUM(w1)FROM penjualan WHERE tahun=@tahun AND bulan= @bulan);
 SET @w2 = (SELECT SUM(w2)FROM penjualan WHERE tahun=@tahun AND bulan= @bulan);
 SET @w3 = (SELECT SUM(w3)FROM penjualan WHERE tahun=@tahun AND bulan= @bulan);
 SET @w4 = (SELECT SUM(w4)FROM penjualan WHERE tahun=@tahun AND bulan= @bulan);
 SET @l0 = (SELECT SUM(l0)FROM penjualan WHERE tahun=@tahun AND bulan= @bulan AND nama_toko='shopee');
 
 SET @l1 = (SELECT COUNT(DISTINCT kode_barang)  FROM penjualan_list  WHERE tahun=@tahun AND bulan=@bulan AND list='l1');
 SET @l2 = (SELECT COUNT(DISTINCT kode_barang)  FROM penjualan_list  WHERE tahun=@tahun AND bulan=@bulan AND list='l2');
 SET @l3 = (SELECT COUNT(DISTINCT kode_barang)  FROM penjualan_list  WHERE tahun=@tahun AND bulan=@bulan AND list='l3');
 SET @l4 = (SELECT COUNT(DISTINCT kode_barang)  FROM penjualan_list  WHERE tahun=@tahun AND bulan=@bulan AND list='l4');
 
 SET @ml1 =(SELECT COUNT(DISTINCT kode_barang) FROM penjualan_listdetail WHERE tahun=@tahun AND bulan=@bulan AND ml='ml1');
 SET @ml2 =(SELECT COUNT(DISTINCT kode_barang) FROM penjualan_listdetail WHERE tahun=@tahun AND bulan=@bulan AND ml='ml2');
 SET @ml3 =(SELECT COUNT(DISTINCT kode_barang) FROM penjualan_listdetail WHERE tahun=@tahun AND bulan=@bulan AND ml='ml3');
 SET @ml4 =(SELECT COUNT(DISTINCT kode_barang) FROM penjualan_listdetail WHERE tahun=@tahun AND bulan=@bulan AND ml='ml4');
 
 SET @list =(SELECT COUNT(*) as list FROM penjualan_list  WHERE tahun=@tahun AND bulan=@bulan);
 
 SET @lt = (@l0 + @list);

 SET @fml =(SELECT COUNT(DISTINCT kode_barang) FROM penjualan_listdetail WHERE tahun=@tahun AND bulan=@bulan);
 
 SET @total = (SELECT SUM(total) FROM penjualan WHERE tahun=@tahun AND bulan= @bulan);
 SET @target = (SELECT SUM(target)FROM penjualan WHERE tahun=@tahun AND bulan= @bulan );


SET @ach =((@total / @target) * 100);


	DECLARE @w1_lama float;
	DECLARE @w2_lama float;
	DECLARE @w3_lama float;
	DECLARE @w4_lama float; 
	DECLARE @bulan_lalu varchar(50);
	
  IF(@bulan='January')
	   BEGIN
		 DECLARE  @tahun_k  int;
		 
		 
		  SET @tahun_k =(CONVERT(INT, @tahun) - 1);
		
		  SET @bulan_lalu ='December'
	      
			 SET @w1_lama = (SELECT SUM(w1)FROM penjualan WHERE tahun=@tahun_k AND bulan= @bulan_lalu);
			 SET @w2_lama = (SELECT SUM(w2)FROM penjualan WHERE tahun=@tahun_k AND bulan= @bulan_lalu);
			 SET @w3_lama = (SELECT SUM(w3)FROM penjualan WHERE tahun=@tahun_k AND bulan= @bulan_lalu);
			 SET @w4_lama = (SELECT SUM(w4)FROM penjualan WHERE tahun=@tahun_k AND bulan= @bulan_lalu);  
			 
			   

	   END
     ELSE
       BEGIN
         SET @bulan_lalu =(SELECT dbo.fun_bulanKemaren(@bulan));
         
          SET @w1_lama = (SELECT SUM(w1)FROM penjualan WHERE tahun=@tahun AND bulan= @bulan_lalu);
          SET @w2_lama = (SELECT SUM(w2)FROM penjualan WHERE tahun=@tahun AND bulan= @bulan_lalu);
          SET @w3_lama = (SELECT SUM(w3)FROM penjualan WHERE tahun=@tahun AND bulan= @bulan_lalu);
          SET @w4_lama = (SELECT SUM(w4)FROM penjualan WHERE tahun=@tahun AND bulan= @bulan_lalu);
         
       END
       
       DECLARE @total_sekarang float;
       DECLARE @total_kemaren float;
       IF(@w4 <>0)
			BEGIN
			 SET @total_sekarang =(@w1 + @w2 + @w3 + @w4);
			 SET @total_kemaren =(@w1_lama + @w2_lama + @w3_lama + @w4_lama);
			END
       ELSE
         BEGIN
			IF(@w3 <>0)
				BEGIN
				 SET @total_sekarang =(@w1 + @w2 + @w3);
				 SET @total_kemaren =(@w1_lama + @w2_lama + @w3_lama);
				END
		   ELSE
		     BEGIN
				 IF(@w2 <>0)
					BEGIN
					 SET @total_sekarang =(@w1 + @w2);
					 SET @total_kemaren =(@w1_lama + @w2_lama);
					END
				  ELSE
				    BEGIN
					 IF(@w1 <>0)
						BEGIN
						 SET @total_sekarang =(@w1);
						 SET @total_kemaren =(@w1_lama);
						END
					  ELSE
					     BEGIN
					      SET @total_sekarang =0;
						 SET @total_kemaren =0;
					     END
					END
			  END
         END
         
      DECLARE @totalgrwoth float;
      
       SET @totalgrwoth  =(((@total_sekarang - @total_kemaren) / @total_kemaren) * 100);
       

 
    CREATE TABLE #temptess2(
	subtotal float,
	bulan varchar(50),
  )  
  
  BEGIN
  INSERT INTO #temptess2(subtotal,bulan)
  SELECT  COALESCE(SUM(total),0),'January' FROM penjualan WHERE tahun=@tahun AND bulan='January';
  
  INSERT INTO #temptess2(subtotal,bulan)
  SELECT  COALESCE(SUM(total),0),'February' FROM penjualan WHERE tahun=@tahun AND bulan='February'
 
   INSERT INTO #temptess2(subtotal,bulan)
  SELECT COALESCE(SUM(total),0),'March' FROM penjualan WHERE tahun=@tahun AND bulan='March'
  
    INSERT INTO #temptess2(subtotal,bulan)
  SELECT  COALESCE(SUM(total),0),'April' FROM penjualan WHERE tahun=@tahun AND bulan='April'
  
    INSERT INTO #temptess2(subtotal,bulan)
  SELECT  COALESCE(SUM(total),0),'May' FROM penjualan WHERE tahun=@tahun AND bulan='May'
  
    INSERT INTO #temptess2(subtotal,bulan)
  SELECT  COALESCE(SUM(total),0),'June' FROM penjualan WHERE tahun=@tahun AND bulan='June'
  
    INSERT INTO #temptess2(subtotal,bulan)
  SELECT  COALESCE(SUM(total),0),'July' FROM penjualan WHERE tahun=@tahun AND bulan='July'
  
    INSERT INTO #temptess2(subtotal,bulan)
  SELECT  COALESCE(SUM(total),0),'August' FROM penjualan WHERE tahun=@tahun AND bulan='August'
  
    INSERT INTO #temptess2(subtotal,bulan)
  SELECT  COALESCE(SUM(total),0),'September' FROM penjualan WHERE tahun=@tahun AND bulan='September'
  
    INSERT INTO #temptess2(subtotal,bulan)
   SELECT  COALESCE(SUM(total),0),'October' FROM penjualan WHERE tahun=@tahun AND bulan='October'
  
    INSERT INTO #temptess2(subtotal,bulan)
    SELECT  COALESCE(SUM(total),0),'November' FROM penjualan WHERE tahun=@tahun AND bulan='November'
  
    INSERT INTO #temptess2(subtotal,bulan)
    SELECT  COALESCE(SUM(total),0),'December' FROM penjualan WHERE tahun=@tahun AND bulan='December'
	
  END
  
 
  
  
  SET @subtotalmax =(SELECT MAX(subtotal) FROM #temptess2);

    
 INSERT INTO #temptess(nama_toko,bulan,tahun,w1,w2,w3,w4,l0,l1,l2,l3,l4,ml1,ml2,ml3,ml4,total,target,ach,lt,fml,growth,subtotalmax)

 SELECT 'Total',@bulan,@tahun,@w1,@w2,@w3,@w4,@l0,@l1,@l2,@l3,@l4,@ml1,@ml2,@ml3,@ml4,@total,@target,@ach,@lt,@fml,@totalgrwoth,@subtotalmax

END;

SELECT * FROM #temptess

GO
EXEC SP_GetTotalGabungan_DGM '2024','January'


