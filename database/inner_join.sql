SELECT u.userid , p.prefixaname, CONCAT(f.firstnamename,' ', l.lastnamename) AS full_name , 
ca.campusname , gr.groupname , br.branchname , co.coursename , emailusername , phoneusername , typename 
FROM tbuser as u
join tbhistoryuser as htu on u.userid = htu.userid
join tbprefix as p on htu.prefixid = p.prefixid
join tbfirstname as f on htu.firstnameid = f.firstnameid
join tblastname as l on htu.lastnameid = l.lastnameid
join tbcourse as co on u.courseid = co.courseid
join tbbranch as br on co.branchid = br.branchid
join tbgroup as gr on br.groupid = gr.groupid
join tbcampus as ca on gr.campusid = ca.campusid
join tblogin as lo on u.loginid = lo.loginid
join tbtype as ty on lo.typeid = ty.typeid
join tbemailuser as mu on htu.historyuserid = mu.historyuserid
join tbphoneuser as pu on htu.historyuserid = pu.historyuserid;

SELECT u.userid , p.prefixaname, CONCAT(f.firstnamename,' ', l.lastnamename) AS full_name , companyname , companyjob , emailcomname , phonecomname
FROM tbuser as u
join tbhistorycom as htc on u.userid = htc.userid
join tbhistoryuser as htu on u.userid = htu.userid
join tbprefix as p on htu.prefixid = p.prefixid
join tbfirstname as f on htu.firstnameid = f.firstnameid
join tblastname as l on htu.lastnameid = l.lastnameid
join tbcompany as co on htc.companyid = co.companyid
join tbemailcom as mc on co.companyid = mc.companyid
join tbphonecom as pc on co.companyid = pc.companyid;