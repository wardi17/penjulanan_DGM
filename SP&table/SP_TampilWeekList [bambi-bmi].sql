USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[SP_GetTransType]    Script Date: 07/16/2024 09:33:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER PROCEDURE [dbo].[SP_TampilWeekList]

AS
IF EXISTS(SELECT [Table_name] FROM tempdb.information_schema.tables WHERE [Table_name] like '#temptess') 
    BEGIN
      DROP TABLE #temptess;
    END;
 IF EXISTS(SELECT [Table_name] FROM tempdb.information_schema.tables WHERE [Table_name] like '#temptess2') 
    BEGIN
      DROP TABLE #temptess2;
    END;   
    
  CREATE TABlE #temptess(
   wilayah varchar(2),
   tahun varchar(4),
   bulan varchar(50),
   bulan_angka varchar(50),
   tgl_awal varchar(50),
   tgl_akhir varchar(50),
  );
  
   CREATE TABlE #temptess2(
   wilayah varchar(2),
   tahun varchar(4),
   bulan varchar(50),
   tgl_awal varchar(50),
   tgl_akhir varchar(50),
   tanggal datetime,
   bulan_angka int
  );

BEGIN
INSERT INTO #temptess
SELECT wilayah,tahun,bulan,
CASE WHEN bulan ='January' THEN 1
 WHEN bulan ='February' THEN 2
 WHEN bulan='March' THEN 3
 WHEN bulan ='April' THEN 4
 WHEN bulan='May' THEN 5
 WHEN bulan ='June' THEN 6
 WHEN bulan ='July' THEN 7
 WHEN bulan='August' THEN 8
 WHEN bulan='September' THEN 9
 WHEN bulan='October' THEN 10
 WHEN bulan='November' THEN 11
 ELSE 12 END AS bulan_angka,
tgl_awal,tgl_akhir FROM bulan_week  ORDER BY  tahun DESC	
END

INSERT INTO #temptess2
SELECT  wilayah,tahun,bulan,tgl_awal,tgl_akhir,
CONVERT(datetime,(tahun +'-'+bulan+'-'+tgl_awal),103) as tanggal,bulan_angka FROM #temptess ORDER BY tahun 


SELECT * FROM #temptess2  ORDER BY tanggal DESC
GO
EXEC SP_TampilWeekList