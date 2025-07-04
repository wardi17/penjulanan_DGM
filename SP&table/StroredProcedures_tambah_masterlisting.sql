USE [bambi-bmi]
GO


SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[tambah_masterlisting]
@kode_barang VARCHAR(100),
@nama_barang VARCHAR(100),
@bulan_posting VARCHAR(5)
AS
BEGIN 

    IF NOT EXISTS(SELECT * FROM [bambi-bmi].[dbo].master_listing_penjualan WHERE kode_barang = @kode_barang and nama_barang = @nama_barang
    and bulan_posting = @bulan_posting ) 
    BEGIN
      INSERT INTO [bambi-bmi].dbo.master_listing_penjualan(kode_barang,nama_barang,bulan_posting,status) Values (@kode_barang, @nama_barang, @bulan_posting,'Y')
    END;
    END;
GO

--exec tambah_masterlisting '10125','Bindex baru','2023';

