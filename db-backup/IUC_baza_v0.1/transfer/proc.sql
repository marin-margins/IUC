DELIMITER ;;
CREATE PROCEDURE setnewid(IN tablename varchar(64))
BEGIN 
SET @rowid:=0;
ALTER TABLE tablename ADD COLUMN new_id int(11);
UPDATE tablename SET new_id=(SELECT @rowid:=@rowid+1) ORDER BY id ASC;
END;;
DELIMITER ;
