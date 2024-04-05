insert into tbtype(typename) values ('admin'),('alumni');

insert into tblogin(loginname, loginpassword, typeid) values ('admin', '$2y$10$FIkHJqi2knPtGHryug8eX.Rz7KBOR49/ePAVnKirn18WBOVBXtNse', 1),('Ta1', '$2y$10$FIkHJqi2knPtGHryug8eX.Rz7KBOR49/ePAVnKirn18WBOVBXtNse', 2);
-- PWD 123!!
insert into tbcampus(campusname) values ('วิทยาเขตสงขลา'),('วิทยาเขตสตูล');

insert into tbgroup(groupname, campusid) values ('คณะวิศวกรรมศาสตร์',1),('คณะวิทยาศาสตร์',2);

insert into tbbranch(branchname, groupid) values ('คอมพิวเตอร์',1),('ไฟฟ้า',2);

insert into tbcourse(courseid, coursename, branchid) values (1,'ปริญญาตรี',1),(2,'ปริญญาโท',2);

insert into tbfirstname(firstnamename) values ('ธนดล1'),('ธนดล2');

insert into tblastname(lastnamename) values ('จันทร์บูรณ์1'),('จันทร์บูรณ์2');

insert into tbprefix(prefixname,prefixaname) values ('นาย','นาย'),('นางสาว','น.ส.');

insert into tbuser(loginid,courseid,districts,useraddress,usercitizen) values (1,1,1,null,1234567891234),(2,2,2,null,1234567894321);

insert into tbhistoryuser(prefixid,firstnameid,lastnameid,userid) values (1,1,1,1),(2,2,2,2);

insert into tbemailuser(emailusername,historyuserid) values ('Ta1@gmail.com',1),('Ta2@gmail.com',2);

insert into tbphoneuser(phoneusername,historyuserid) values ('0990114444',1),('0880114444',2);

insert into tbcompany(companyname,companyjob,districts) values ('ไทยจำกัด','พนักงานง',1),('อังกฤษจำกัด','เจ้าหน้าที่',2);

insert into tbemailcom(emailcomname,companyid) values ('Tac1@gmail.com',1),('Tac2@gmail.com',2);

insert into tbphonecom(phonecomname,companyid) values ('0770114444',1),('0660114444',2);

insert into tbhistorycom(userid,companyid) values (1,1),(2,2);

insert into tbpostwork(postworktext,postworksummit,userid) values ('งาน1',0,1),('งาน2',1,1);

-- Exaple
INSERT INTO tbprefix (prefixname, prefixaname) VALUES ('value8', 'value9'); 
SELECT LAST_INSERT_ID();

INSERT INTO tbhistoryuser (prefixid, firstnameid, lastnameid) VALUES ('$prefixid', '$firstnamename_id', '$lastnamename_id');
SELECT last_insert_rowid();

insert into tbemailuser
(emailusername,historyuserid)
values
  ('Ta2@gmail.com',2)
  
on duplicate key update historyuserid = values(historyuserid)
  