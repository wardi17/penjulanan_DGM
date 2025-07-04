CREATE TABLE [dbo].[master_listing_penjualan](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[kode_barang] [varchar](20) NULL,
	[nama_barang] [varchar](150) NULL,
	[bulan_posting] [varchar](150) NULL,
	[status] [varchar](10) NULL,
 CONSTRAINT [PK_master_listing_penjualan] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO