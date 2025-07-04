
ALTER function [dbo].[fun_bulanKemaren](
@bulan_s varchar(100)
)
returns varchar(100) as 
begin
DECLARE @bulan_k varchar(100);

  if(@bulan_s ='February')
	  BEGIN
	   SET @bulan_k ='January';
	  END

  if(@bulan_s ='March')
	  BEGIN
	   SET @bulan_k ='February';
	  END
  if(@bulan_s ='April')
	  BEGIN
	   SET @bulan_k ='March';
	  END
  if(@bulan_s ='May')
	  BEGIN
	    SET @bulan_k ='April';
	  END
  if(@bulan_s ='Juny')
	  BEGIN
	    SET @bulan_k ='May';
	  END	 
  if(@bulan_s ='July')
	  BEGIN
	 SET @bulan_k ='Juny';
	  END	
  if(@bulan_s ='August')
	  BEGIN
	   SET @bulan_k ='Juny';
	  END	

   if(@bulan_s ='September')
	  BEGIN
	 SET @bulan_k ='August';
	  END	
   if(@bulan_s ='Oktoberc')
	  BEGIN
	 SET @bulan_k ='September';
	  END
  if(@bulan_s ='November')
	  BEGIN
	  SET @bulan_k ='Oktoberc';
	  END
  if(@bulan_s ='December')
	  BEGIN
	 SET @bulan_k ='November';
	  END	

 return @bulan_k;
end

go
print dbo.fun_bulanKemaren('November')
