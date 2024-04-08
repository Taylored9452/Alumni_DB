CREATE DATABASE alumni_db DEFAULT CHARACTER SET utf16 
COLLATE utf16_general_ci;

use alumni_db;

CREATE TABLE tbtype(
	typeid						int(10)        		 NOT NULL AUTO_INCREMENT,
	typename              		varchar(50)        COLLATE utf16_general_ci NOT NULL,
	
    constraint PK_Type primary key (typeid)
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tblogin(
	loginid						int(10)        		 NOT NULL AUTO_INCREMENT,
	loginname					varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	loginpassword              	varchar(255)        COLLATE utf16_general_ci NOT NULL,
	typeid						int(11)				 NOT NULL DEFAULT 2,
    
    PRIMARY KEY (loginid), 
    constraint FK_Login_Type foreign key (typeid) references tbtype(typeid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

-- TB School

CREATE TABLE tbcampus(
	campusid					int(10)        		 NOT NULL AUTO_INCREMENT,
	campusname              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	
    constraint PK_Campus primary key (campusid)
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbgroup(
	groupid						int(10)        		 NOT NULL AUTO_INCREMENT,
	groupname              		varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	campusid					int(11)				 NOT NULL,
    
    PRIMARY KEY (groupid), 
    constraint FK_Group_Campus foreign key (campusid) references tbcampus(campusid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbbranch(
	branchid					int(10)        		 NOT NULL AUTO_INCREMENT,
	branchname              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	groupid						int(11)				 NOT NULL,
    
    PRIMARY KEY (branchid), 
    constraint FK_Branch_Group foreign key (groupid) references tbgroup(groupid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbcourse(
	courseid					int(10)        		 NOT NULL,
	coursename              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	branchid					int(11)				 NOT NULL,
    
    PRIMARY KEY (courseid), 
    constraint FK_Course_Branch foreign key (branchid) references tbbranch(branchid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbuser(
	userid						int(10)        		 NOT NULL AUTO_INCREMENT,
	loginid              		int(11)				 NULL,
	-- historyuserid				int(11)				 NULL,
    courseid					int(11)				 NULL,
    districts					int(11)				 NULL,
    useraddress					varchar(255)        COLLATE utf16_general_ci NULL,
    userbirthday              	date            	DEFAULT CURRENT_TIMESTAMP NULL,
    usercitizen              	varchar(13)        	NULL,
    userimg              		mediumtext        	NULL,
    usertime					timestamp            DEFAULT CURRENT_TIMESTAMP NULL,
    
    PRIMARY KEY (userid),
    constraint FK_User_Loginname foreign key (loginid) references tblogin(loginid) ON update cascade
    -- constraint FK_User_Historyuser foreign key (historyuserid) references tbhistoryuser(historyuserid) ON update cascade,
    -- constraint FK_User_Course foreign key (courseid) references tbcourse(courseid) ON update cascade
    -- constraint FK_User_districts foreign key (id) references districts(id) ON update cascade
)ENGINE=InnoDB default charset=utf16;

-- TB historyUser

CREATE TABLE tbfirstname(
	firstnameid					int(10)        		 NOT NULL AUTO_INCREMENT,
	firstnamename              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	
    constraint PK_Campus primary key (firstnameid)
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tblastname(
	lastnameid					int(10)        		 NOT NULL AUTO_INCREMENT,
	lastnamename              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	
    constraint PK_Campus primary key (lastnameid)
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbprefix(
	prefixid					int(10)        		 NOT NULL AUTO_INCREMENT,
	prefixname              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
    prefixaname              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	
    constraint PK_Campus primary key (prefixid)
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbhistoryuser(
	historyuserid				int(10)        		 NOT NULL AUTO_INCREMENT,
    prefixid              		int(11)				 NOT NULL,
    firstnameid              	int(11)				 NOT NULL,
    lastnameid              	int(11)				 NOT NULL,
    userid              		int(10)        		 NOT NULL,
    historyusertime				timestamp            DEFAULT CURRENT_TIMESTAMP NULL,
    
    PRIMARY KEY (historyuserid), 
    constraint FK_Historyuser_Prefix foreign key (prefixid) references tbprefix(prefixid) ON update cascade,
    constraint FK_Historyuser_Firstname foreign key (firstnameid) references tbfirstname(firstnameid) ON update cascade,
    constraint FK_Historyuser_Lastname foreign key (lastnameid) references tblastname(lastnameid) ON update cascade,
    constraint FK_Historyuser_User foreign key (userid) references tbuser(userid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbemailuser(
	emailuserid					int(10)        		 NOT NULL AUTO_INCREMENT,
	emailusername              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	historyuserid				int(11)				 NOT NULL,
    
    PRIMARY KEY (emailuserid), 
    constraint FK_Emailuser_Historyuser foreign key (historyuserid) references tbhistoryuser(historyuserid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbphoneuser(
	phoneuserid					int(10)        		 NOT NULL AUTO_INCREMENT,
	phoneusername              	varchar(50)        COLLATE utf16_general_ci NOT NULL UNIQUE,
	historyuserid				int(11)				 NOT NULL,
    
    PRIMARY KEY (phoneuserid), 
    constraint FK_Phoneuser_Historyuser foreign key (historyuserid) references tbhistoryuser(historyuserid) ON update cascade
)ENGINE=InnoDB default charset=utf16;


-- TB post

CREATE TABLE news(
	id					        int(10)        		 NOT NULL AUTO_INCREMENT,
    title              	        varchar(255)        COLLATE utf16_general_ci NULL,
    content              	    mediumtext          COLLATE utf16_general_ci NULL, 
    image                       mediumtext        	COLLATE utf16_general_ci NULL,
    created_at				    timestamp            DEFAULT CURRENT_TIMESTAMP NULL,
    category_id					int(10)        		 NOT NULL,
    
    constraint PK_Type primary key (id) 
)ENGINE=InnoDB default charset=utf16;

ALTER TABLE tbpostwork
	MODIFY postworkimg mediumtext, MODIFY postworktext mediumtext;
select * from tbpostwork;     
    
-- TB Company 

CREATE TABLE tbcompany(
	companyid					int(10)        		 NOT NULL AUTO_INCREMENT,
	companyname              	varchar(50)        	COLLATE utf16_general_ci NOT NULL,
    companyjob					varchar(50)        	COLLATE utf16_general_ci NOT NULL,
	districts					int(11)				 NOT NULL,
    
    PRIMARY KEY (companyid) 
    -- constraint FK_Company_Tambon foreign key (tambonid) references tbtambon(tambonid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbemailcom(
	emailcomid					int(10)        		 NOT NULL AUTO_INCREMENT,
	emailcomname              	varchar(50)        	COLLATE utf16_general_ci NOT NULL UNIQUE,
	companyid					int(11)				 NOT NULL,
    
    PRIMARY KEY (emailcomid), 
    constraint FK_Emailcom_Company foreign key (companyid) references tbcompany(companyid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

drop table tbemailcom;

CREATE TABLE tbphonecom(
	phonecomid					int(10)        		 NOT NULL AUTO_INCREMENT,
	phonecomname              	varchar(50)        	COLLATE utf16_general_ci NOT NULL UNIQUE,
	companyid					int(11)				 NOT NULL,
    
    PRIMARY KEY (phonecomid), 
    constraint FK_Phonecom_Company foreign key (companyid) references tbcompany(companyid) ON update cascade
)ENGINE=InnoDB default charset=utf16;

CREATE TABLE tbhistorycom(
	historycomid				int(10)        		 NOT NULL AUTO_INCREMENT,
	userid              		int(10)        		 NOT NULL,
    companyid					int(10)        		 NOT NULL,
	historycomtime				timestamp            DEFAULT CURRENT_TIMESTAMP NULL,
    
    PRIMARY KEY (historycomid), 
    constraint FK_Historycom_User foreign key (userid) references tbuser(userid) ON update cascade,
    constraint FK_Historycom_Company foreign key (companyid) references tbcompany(companyid) ON update cascade
)ENGINE=InnoDB default charset=utf16;
