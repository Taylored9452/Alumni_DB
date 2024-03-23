CREATE DATABASE alumni_db DEFAULT CHARACTER SET utf16 
COLLATE utf16_general_ci;

use alumni_db;

CREATE TABLE tbtype(
	typeid						int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	typename              		varchar(50)        COLLATE utf16_general_ci NOT NULL,
	
    constraint PK_Type primary key (typeid)
)ENGINE=InnoDB default charset=utf16;

insert into tbtype(typename) values ('admin');
insert into tbtype(typename) values ('alumni');
select * from tbtype;

CREATE TABLE tblogin(
	loginname					varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	loginpassword              	varchar(50)        COLLATE utf16_general_ci NOT NULL,
	typeid						int(11)				UNSIGNED NOT NULL DEFAULT 2,
    
    PRIMARY KEY (loginname), 
    constraint FK_Login_Type foreign key (typeid) references tbtype(typeid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

insert into tblogin(loginname, loginpassword, typeid) values ('Ta1', '1234', 1);
insert into tblogin(loginname, loginpassword, typeid) values ('Ta2', '5678', 2);
select * from tblogin;
select a.loginname, a.loginpassword, b.typename
from tblogin as a 
inner join tbtype as b on a.typeid = b.typeid;

ALTER TABLE tblogin MODIFY typeid int(11) UNSIGNED NOT NULL DEFAULT 2;

CREATE TABLE tbuser(
	userid						int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	loginname              		varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	historyuserid				int(11)				UNSIGNED NOT NULL,
    courseid					int(11)				UNSIGNED NOT NULL,
    tambonid					int(11)				UNSIGNED NOT NULL,
    useraddress					varchar(255)        COLLATE utf16_general_ci NULL,
    userbirthday              	datetime            DEFAULT CURRENT_TIMESTAMP NULL,
    usercitizen              	varchar(13)        	NOT NULL,
    
    PRIMARY KEY (userid),
    constraint FK_User_Loginname foreign key (loginname) references tblogin(loginname) ON update cascade,
    constraint FK_User_Historyuser foreign key (historyuserid) references tbhistoryuser(historyuserid) ON update cascade,
    constraint FK_User_Course foreign key (courseid) references tbcourse(courseid) ON update cascade,
    constraint FK_User_Tambon foreign key (tambonid) references tbtambon(tambonid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

alter table tbuser MODIFY usercitizen varchar(13) NOT NULL;
select * from tbuser;

select userid, loginname, p.prefixname , f.firstnamename , l.lastnamename
from tbhistoryuser as p 
inner join tbcity as b on a.cityid = b.cityid
inner join tbprovince as c on b.provinceid = c.provinceid;

-- TB Place

CREATE TABLE tbprovince(
	provinceid					int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	provincename              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,

    constraint PK_Province primary key (provinceid)
)ENGINE=InnoDB default charset=utf16;

insert into tbprovince(provincename) values ('สงขลา');
insert into tbprovince(provincename) values ('สตูล');
select * from tbprovince;

CREATE TABLE tbcity(
	cityid						int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	cityname              		varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	provinceid					int(11)				UNSIGNED NOT NULL,
    
    PRIMARY KEY (cityid), 
    constraint FK_City_Province foreign key (provinceid) references tbprovince(provinceid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

insert into tbcity(cityname, provinceid) values ('เมืองสงขลา',1);
insert into tbcity(cityname, provinceid) values ('เมืองสตูล',2);
select * from tbcity;

CREATE TABLE tbtambon(
	tambonid					int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	tambonname              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	cityid						int(11)				UNSIGNED NOT NULL,
    tambonpostcode				int(10)				UNSIGNED NOT NULL,
    
    PRIMARY KEY (tambonid), 
    constraint FK_Tambon_City foreign key (cityid) references tbcity(cityid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

insert into tbtambon(tambonname,cityid,tambonpostcode) values ('สิงหนคร',1,'90000');
insert into tbtambon(tambonname,cityid,tambonpostcode) values ('พิมาน',2,'91000');
select * from tbtambon;
select a.tambonname, b.cityname, c.provincename , tambonpostcode
from tbtambon as a 
inner join tbcity as b on a.cityid = b.cityid
inner join tbprovince as c on b.provinceid = c.provinceid;

-- TB School

CREATE TABLE tbcampus(
	campusid					int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	campusname              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	
    constraint PK_Campus primary key (campusid)
)ENGINE=InnoDB default charset=utf16;

insert into tbcampus(campusname) values ('วิทยาเขตสงขลา');
insert into tbcampus(campusname) values ('วิทยาเขตสตูล');
select * from tbcampus;

CREATE TABLE tbgroup(
	groupid						int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	groupname              		varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	campusid					int(11)				UNSIGNED NOT NULL,
    
    PRIMARY KEY (groupid), 
    constraint FK_Group_Campus foreign key (campusid) references tbcampus(campusid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

insert into tbgroup(groupname, campusid) values ('คณะวิศวกรรมศาสตร์',1);
insert into tbgroup(groupname, campusid) values ('คณะวิทยาศาสตร์',2);
select * from tbgroup;
update tbgroup set groupname = 'คณะวิศวกรรมศาสตร์' where groupid = 1;
update tbgroup set groupname = 'คณะวิทยาศาสตร์' where groupid = 2; 

CREATE TABLE tbbranch(
	branchid					int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	branchname              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	groupid						int(11)				UNSIGNED NOT NULL,
    
    PRIMARY KEY (branchid), 
    constraint FK_Branch_Group foreign key (groupid) references tbgroup(groupid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

insert into tbbranch(branchname, groupid) values ('คอมพิวเตอร์',1);
insert into tbbranch(branchname, groupid) values ('ไฟฟ้า',2);
select * from tbbranch;

CREATE TABLE tbcourse(
	courseid					int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	coursename              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	branchid					int(11)				UNSIGNED NOT NULL,
    
    PRIMARY KEY (courseid), 
    constraint FK_Course_Branch foreign key (branchid) references tbbranch(branchid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

insert into tbcourse(coursename, branchid) values ('ปริญญาตรี',1);
insert into tbcourse(coursename, branchid) values ('ปริญญาโท',2);
select * from tbcourse;
select d.campusname, c.groupname, b.branchname , a.coursename
from tbcourse as a 
inner join tbbranch as b on a.branchid = b.branchid 
inner join tbgroup as c on b.groupid = c.groupid 
inner join tbcampus as d on c.campusid = d.campusid;

-- TB historyUser

CREATE TABLE tbfirstname(
	firstnameid					int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	firstnamename              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	
    constraint PK_Campus primary key (firstnameid)
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tblastname(
	lastnameid					int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	lastnamename              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	
    constraint PK_Campus primary key (lastnameid)
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbprefix(
	prefixid					int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	prefixname              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
    prefixaname              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	
    constraint PK_Campus primary key (prefixid)
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbhistoryuser(
	historyuserid				int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
    prefixid              		int(11)				UNSIGNED NOT NULL,
    firstnameid              	int(11)				UNSIGNED NOT NULL,
    lastnameid              	int(11)				UNSIGNED NOT NULL,
    historyusertime				datetime            DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NULL,
    
    PRIMARY KEY (historyuserid), 
    constraint FK_Historyuser_Prefix foreign key (prefixid) references tbprefix(prefixid) ON update cascade,
    constraint FK_Historyuser_Firstname foreign key (firstnameid) references tbfirstname(firstnameid) ON update cascade,
    constraint FK_Historyuser_Lastname foreign key (lastnameid) references tblastname(lastnameid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbemailuser(
	emailuserid					int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	emailusername              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	historyuserid				int(11)				UNSIGNED NOT NULL,
    
    PRIMARY KEY (emailuserid), 
    constraint FK_Emailuser_Historyuser foreign key (historyuserid) references tbhistoryuser(historyuserid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbphoneuser(
	phoneuserid					int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	phoneusername              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	historyuserid				int(11)				UNSIGNED NOT NULL,
    
    PRIMARY KEY (phoneuserid), 
    constraint FK_Phoneuser_Historyuser foreign key (historyuserid) references tbhistoryuser(historyuserid) ON update cascade
)ENGINE=InnoDB default charset=utf16;


-- TB post

CREATE TABLE tbpostwork(
	postworkid					int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
    postworkimg              	mediumtext        NULL, -- mediumtext
    postworktext              	mediumtext        COLLATE utf16_general_ci NULL, -- mediumtext
    postworkdatetime            timestamp        	DEFAULT CURRENT_TIMESTAMP NULL,
    postworksummit				boolean            	DEFAULT FALSE  NOT NULL,
    userid						int(10)        		UNSIGNED NOT NULL,
    
    PRIMARY KEY (postworkid), 
    constraint FK_Postwork_User foreign key (userid) references tbuser(userid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

ALTER TABLE tbpostwork
	MODIFY postworkimg mediumtext, MODIFY postworktext mediumtext;
select * from tbpostwork;     
    
-- TB Company 

CREATE TABLE tbcompany(
	companyid					int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	companyname              	varchar(50)        	COLLATE utf16_general_ci NOT NULL,
    companyjob					varchar(50)        	COLLATE utf16_general_ci NOT NULL,
	tambonid					int(11)				UNSIGNED NOT NULL,
    
    PRIMARY KEY (companyid), 
    constraint FK_Company_Tambon foreign key (tambonid) references tbtambon(tambonid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbemailcom(
	emailcomid					int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	emailcomname              	varchar(50)        	COLLATE utf16_general_ci NOT NULL UNIQUE,
	companyid					int(11)				UNSIGNED NOT NULL,
    
    PRIMARY KEY (emailcomid), 
    constraint FK_Emailcom_Company foreign key (companyid) references tbcompany(companyid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

drop table tbemailcom;

CREATE TABLE tbphonecom(
	phonecomid					int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	phonecomname              	varchar(50)        	COLLATE utf16_general_ci NOT NULL UNIQUE,
	companyid					int(11)				UNSIGNED NOT NULL,
    
    PRIMARY KEY (phonecomid), 
    constraint FK_Phonecom_Company foreign key (companyid) references tbcompany(companyid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbhistorycom(
	historycomid				int(10)        		UNSIGNED NOT NULL AUTO_INCREMENT,
	userid              		int(10)        		UNSIGNED NOT NULL,
    companyid					int(10)        		UNSIGNED NOT NULL,
	historyusertime				datetime            DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NULL,
    
    PRIMARY KEY (historycomid), 
    constraint FK_Historycom_User foreign key (userid) references tbuser(userid) ON update cascade,
    constraint FK_Historycom_Company foreign key (companyid) references tbcompany(companyid) ON update cascade
)ENGINE=InnoDB default charset=utf16;