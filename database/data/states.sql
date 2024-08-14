
DROP TABLE IF EXISTS states;
CREATE TABLE states(
   id         INTEGER  NOT NULL PRIMARY KEY
  ,name       VARCHAR(11) NOT NULL
  ,name_mm    VARCHAR(10) NOT NULL
  ,created_at timestamp NULL DEFAULT NULL
  ,updated_at timestamp NULL DEFAULT NULL
);

ALTER TABLE states
  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

INSERT INTO states(created_at,id,name,name_mm,updated_at) VALUES ('2022-10-03 07:16:59',1,'Kachin','ကချင်','2022-10-03 07:16:59');
INSERT INTO states(created_at,id,name,name_mm,updated_at) VALUES ('2022-10-03 07:16:59',2,'Kayah','ကယား','2022-10-03 07:16:59');
INSERT INTO states(created_at,id,name,name_mm,updated_at) VALUES ('2022-10-03 07:16:59',3,'Kayin','ကရင်','2022-10-03 07:16:59');
INSERT INTO states(created_at,id,name,name_mm,updated_at) VALUES ('2022-10-03 07:16:59',4,'Chin','ချင်း','2022-10-03 07:16:59');
INSERT INTO states(created_at,id,name,name_mm,updated_at) VALUES ('2022-10-03 07:16:59',5,'Mon','မွန်','2022-10-03 07:16:59');
INSERT INTO states(created_at,id,name,name_mm,updated_at) VALUES ('2022-10-03 07:16:59',6,'Rakhine','ရခိုင်','2022-10-03 07:16:59');
INSERT INTO states(created_at,id,name,name_mm,updated_at) VALUES ('2022-10-03 07:16:59',7,'Shan','ရှမ်း','2022-10-03 07:16:59');
INSERT INTO states(created_at,id,name,name_mm,updated_at) VALUES ('2022-10-03 07:16:59',8,'Yangon','ရန်ကုန်','2022-10-03 07:16:59');
INSERT INTO states(created_at,id,name,name_mm,updated_at) VALUES ('2022-10-03 07:16:59',9,'Mandalay','မန္တလေး','2022-10-03 07:16:59');
INSERT INTO states(created_at,id,name,name_mm,updated_at) VALUES ('2022-10-03 07:16:59',10,'Sagaing','စစ်ကိုင်း','2022-10-03 07:16:59');
INSERT INTO states(created_at,id,name,name_mm,updated_at) VALUES ('2022-10-03 07:16:59',11,'Magway','မကွေး','2022-10-03 07:16:59');
INSERT INTO states(created_at,id,name,name_mm,updated_at) VALUES ('2022-10-03 07:16:59',12,'Bago','ပဲခူး','2022-10-03 07:16:59');
INSERT INTO states(created_at,id,name,name_mm,updated_at) VALUES ('2022-10-03 07:16:59',13,'Ayeyarwady','ဧရာဝတီ','2022-10-03 07:16:59');
INSERT INTO states(created_at,id,name,name_mm,updated_at) VALUES ('2022-10-03 07:16:59',14,'Tanintharyi','တနသာင်္ရီ','2022-10-03 07:16:59');
INSERT INTO states(created_at,id,name,name_mm,updated_at) VALUES ('2022-10-03 07:16:59',15,'Nay Pyi Taw','နေပြည်တော်','2022-10-03 07:16:59');
