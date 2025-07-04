USE [bambi-bmi]
GO
/****** Object:  StoredProcedure [dbo].[trankasi_bulan]    Script Date: 08/23/2023 10:38:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

ALTER PROCEDURE [dbo].[trankasi_bulan]
@nama  VARCHAR(100),
@bulan VARCHAR(100),
@tahun VARCHAR(100)
AS
BEGIN 

SELECT w1,w2,w3,w4 FROM 
[penjualan] WHERE  nama_toko =@nama AND bulan =@bulan AND tahun=@tahun



END;


