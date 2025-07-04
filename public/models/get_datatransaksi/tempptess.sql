-- (CASE WHEN status = 'S' THEN 'SUDAH' ELSE 'TIDAK' END),


insert into #temptess

SELECT s.sotransacid, s.sodocumenid, 'CIBINONG', s.shipdate, s.country, s.shipcountry, sd.ppnpercen, s.flagso04, ((sd.qtyoutstanding*sd.unitPrice)-(((sd.qtyoutstanding*sd.unitprice)*sd.discpercen)/100)), s.customerid, s.custname, sd.partid, sd.qtyoutstanding, 'DGM',
(select count(b.sotransacid) from [bambi-bmi].[dbo].[so_cash] b where b.sotransacid = s.sotransacid and b.divisi = s.divisi)
 FROM [bambi-bmi].[dbo].[SOTRANSACTIONDETAIL] AS sd INNER JOIN [bambi-bmi].[dbo].[SOTRANSACTION] AS s 
 ON sd.[SOTransacID] = s.[SOTransacID] WHERE ([s].[divisi] = 'DGM') AND flagposted = 'Y' AND s.flagdo = 'N' AND s.flagcancelSOPosted is NULL AND s.shipdate >= @dtglAwal




-- ///////////batas /////////////

 USE [bambi-bmi]
GO

/****** Object:  StoredProcedure [dbo].[lihatanak]    Script Date: 04/11/2023 07:58:12 ******/
SET ANSI_NULLS ON
GO





SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[get_penjualan_emount] 
  @tanggal_awal datetime,
  @tanggal_akhir datetime,
  @nama_toko VARCHAR(35),
  @posted char(1)

AS
BEGIN

IF EXISTS(SELECT [Table_name] FROM tempdb.information_schema.tables WHERE [Table_name] like '#temptess') 
    BEGIN
      DROP TABLE #temptess;
    END;


 create table #temptess
(
	SOTransacID char(15),
	CustomerID char(10),
	shipdate datetime,
    Total float
);

 create table #temptess2
(
	SOTransacID char(15),
	CustomerID char(10),
	shipdate datetime,
    total_presen float
);

 create table #temptess3
(
    amount float
)

INSERT INTO #temptess

SELECT   S.SOTransacID,S.CustomerID ,S.shipdate,((D.Quantity * D.UnitPrice) - (D.discpercen))as total
 FROM SOTRANSACTION  AS S   
INNER JOIN  SOTRANSACTIONDETAIL AS D ON S.SOTransacID = D.SOTransacID
WHERE  S.shipdate  BETWEEN @tanggal_awal  AND  @tanggal_akhir AND  S.CustomerID =@nama_toko
AND S.FlagPosted =@posted AND S.flagcancelSO is NULL

INSERT INTO #temptess2
SELECT  SOTransacID,CustomerID,shipdate, CASE WHEN Total >= 0 THEN  Total /100  ELSE  0 END FROM  #temptess


INSERT INTO #temptess3
SELECT SUM(total_presen) FROM #temptess2;

END;

SELECT  ROUND(amount, 3) as amount FROM #temptess3

GO



EXEC get_penjualan_emount '2023-04-01','2023-04-08','SHOPEE','Y';


