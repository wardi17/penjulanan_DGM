USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_TampilDataSubTotaltahunan]    Script Date: 07/19/2024 15:50:00 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER OFF
GO
ALTER PROCEDURE [dbo].[SP_TampilDataGrainTotal_DGM]
@tahun VARCHAR(4),
@bulan VARCHAR(100)
AS

BEGIN 
IF EXISTS(SELECT [Table_name] FROM tempdb.information_schema.tables WHERE [Table_name] like '#temptess') 
    BEGIN
      DROP TABLE #temptess;
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

)
    
   -- variabel tahun sekarang 
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
	DECLARE @fl float;
	DECLARE @fml float;
	DECLARE @list float;
 -- and variabel kurang tahun sekarang 

 -- variabel  dari bulan sekarang 
	DECLARE @w1_skg float;
	DECLARE @w2_skg float;
	DECLARE @w3_skg float;
	DECLARE @w4_skg float; 
 -- and variabel  dari bulan sekarang 
  -- variabel tahun sebelum nya 
	DECLARE @w1_sbm float;
	DECLARE @w2_sbm float;
	DECLARE @w3_sbm float;
	DECLARE @w4_sbm float; 

	DECLARE @growth_sbm float;

	DECLARE @w1_bln_sbm float;
	DECLARE @w2_bln_sbm float;
	DECLARE @w3_bln_sbm float;
	DECLARE @w4_bln_sbm float; 
 -- and tahun sebelum nya 

	

 --untuk data tampiltahun tahun sekarang
	 SET @w1 = (SELECT SUM(w1)FROM penjualan WHERE tahun=@tahun);
	 SET @w2 = (SELECT SUM(w2)FROM penjualan WHERE tahun=@tahun);
	 SET @w3 = (SELECT SUM(w3)FROM penjualan WHERE tahun=@tahun);
	 SET @w4 = (SELECT SUM(w4)FROM penjualan WHERE tahun=@tahun);
	 SET @l0 = (SELECT SUM(l0)FROM penjualan WHERE tahun=@tahun AND bulan= @bulan AND nama_toko='SHOPEE');
	 
	 SET @l1 = (SELECT COUNT(DISTINCT kode_barang)  FROM penjualan_list  WHERE tahun=@tahun AND list='l1');
	 SET @l2 = (SELECT COUNT(DISTINCT kode_barang)  FROM penjualan_list  WHERE tahun=@tahun AND list='l2');
	 SET @l3 = (SELECT COUNT(DISTINCT kode_barang)  FROM penjualan_list  WHERE tahun=@tahun AND list='l3');
	 SET @l4 = (SELECT COUNT(DISTINCT kode_barang)  FROM penjualan_list  WHERE tahun=@tahun AND list='l4');
	 
	 SET @ml1 =(SELECT COUNT(DISTINCT kode_barang) FROM penjualan_listdetail WHERE tahun=@tahun AND ml='ml1');
	 SET @ml2 =(SELECT COUNT(DISTINCT kode_barang) FROM penjualan_listdetail WHERE tahun=@tahun AND ml='ml2');
	 SET @ml3 =(SELECT COUNT(DISTINCT kode_barang) FROM penjualan_listdetail WHERE tahun=@tahun AND ml='ml3');
	 SET @ml4 =(SELECT COUNT(DISTINCT kode_barang) FROM penjualan_listdetail WHERE tahun=@tahun AND ml='ml4');
	 SET @list =(SELECT COUNT(*) as list FROM penjualan_list  WHERE tahun=@tahun AND bulan=@bulan);
	
	 SET @fl = (@l0 + @list);

	 SET @fml =(SELECT COUNT(DISTINCT kode_barang) FROM penjualan_listdetail WHERE tahun=@tahun);
	 
	 SET @total = (SELECT SUM(total) FROM penjualan WHERE tahun=@tahun);
	 SET @target = (SELECT SUM(target)FROM penjualan WHERE tahun=@tahun);
 --and untuk data tampiltahun  sekarang

  -- untuk mencari filter week bulan kemaren ada atau tidak
     SET @w1_skg = (SELECT SUM(w1)FROM penjualan WHERE tahun=@tahun AND bulan=@bulan);
	 SET @w2_skg = (SELECT SUM(w2)FROM penjualan WHERE tahun=@tahun AND bulan=@bulan);
	 SET @w3_skg = (SELECT SUM(w3)FROM penjualan WHERE tahun=@tahun AND bulan=@bulan);
	 SET @w4_skg = (SELECT SUM(w4)FROM penjualan WHERE tahun=@tahun AND bulan=@bulan);
	 
  --and untuk mencari filter week bulan kemaren ada atau tidak
  --Untuk mencari data tahun sebelum nya
     DECLARE  @tahun_k  int;
     DECLARE @cekdatatahusb int;
	 SET @tahun_k =(CONVERT(INT, @tahun) - 1);
	 
	 SET @cekdatatahusb = (SELECT  CASE WHEN COUNT(*) <> 0 THEN 1 ELSE 0 END  FROM penjualan WHERE tahun=@tahun_k);
	 
	 IF(@cekdatatahusb <>0) 
	  BEGIN
	   
		 SET @w1_sbm = (SELECT SUM(w1)FROM penjualan WHERE tahun=@tahun_k);
		 SET @w2_sbm = (SELECT SUM(w2)FROM penjualan WHERE tahun=@tahun_k);
		 SET @w3_sbm = (SELECT SUM(w3)FROM penjualan WHERE tahun=@tahun_k);
		 SET @w4_sbm = (SELECT SUM(w4)FROM penjualan WHERE tahun=@tahun_k);
		
		 SET @w1_bln_sbm = (SELECT SUM(w1)FROM penjualan WHERE tahun=@tahun_k AND bulan=@bulan);
		 SET @w2_bln_sbm = (SELECT SUM(w2)FROM penjualan WHERE tahun=@tahun_k AND bulan=@bulan);
		 SET @w3_bln_sbm = (SELECT SUM(w3)FROM penjualan WHERE tahun=@tahun_k AND bulan=@bulan);
		 SET @w4_bln_sbm = (SELECT SUM(w4)FROM penjualan WHERE tahun=@tahun_k AND bulan=@bulan);
	  END
    ELSE
      BEGIN
		SET @w1_sbm =0;
		 SET @w2_sbm = 0;
		 SET @w3_sbm = 0;
		 SET @w4_sbm = 0;
		
		 SET @w1_bln_sbm = 0;
		 SET @w2_bln_sbm = 0;
		 SET @w3_bln_sbm = 0;
		 SET @w4_bln_sbm = 0;
      END
 SET @ach =((@total / @target) * 100);


  	
       DECLARE @total_thn_sekarang float;
       DECLARE @total_thn_kemaren float;
       IF(@w4_skg <>0)
			BEGIN
			 SET @total_thn_sekarang =(@w1 + @w2 + @w3 + @w4);
			 SET @total_thn_kemaren =(@w1_sbm + @w2_sbm + @w3_sbm + @w4_sbm);
			END
       ELSE
         BEGIN
			IF(@w3_skg <>0)
				BEGIN
				 SET @total_thn_sekarang =(@w1 + @w2 + @w3);
				 SET @total_thn_kemaren =((@w1_sbm + @w2_sbm + @w3_sbm)-@w4_bln_sbm);
				END
		   ELSE
		     BEGIN
				 IF(@w2_skg <>0)
					BEGIN
					 SET @total_thn_sekarang =(@w1 + @w2);
					 SET @total_thn_kemaren =((@w1_sbm + @w2_sbm)-@w3_bln_sbm);
					END
				  ELSE
				    BEGIN
					 IF(@w1_skg <>0)
						BEGIN
						 SET @total_thn_sekarang =(@w1);
						 SET @total_thn_kemaren =((@w1_sbm)-@w2_bln_sbm);
						END
					  ELSE
					     BEGIN
					      SET @total_thn_sekarang =0;
						 SET @total_thn_kemaren =0;
					     END
					END
			  END
         END
        
      DECLARE @totalgrwoth float;
        IF( @total_thn_kemaren <>  0)
           BEGIN
            SET @totalgrwoth  =(((@total_thn_sekarang - @total_thn_kemaren) / @total_thn_kemaren) * 100);
           END
         ELSE 
           BEGIN
                  SET @totalgrwoth  = 0;
           END

  
 INSERT INTO #temptess(nama_toko,bulan,tahun,w1,w2,w3,w4,l0,l1,l2,l3,l4,ml1,ml2,ml3,ml4,total,target,ach,growth,lt,fml)
 SELECT 'G TOTAL',@bulan,@tahun,@w1,@w2,@w2,@w4,@l0,@l1,@l2,@l3,@l4,@ml1,@ml2,@ml3,@ml4,@total,@target,@ach,@totalgrwoth,@fl,@fml


END;

SELECT * FROM #temptess
GO
EXEC SP_TampilDataGrainTotal_DGM '2023','December'

