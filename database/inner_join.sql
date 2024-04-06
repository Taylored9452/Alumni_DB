SELECT u.userid  , p.prefixaname, CONCAT(f.firstnamename,' ', l.lastnamename) AS full_name ,
ca.campusname , gr.groupname , br.branchname , co.coursename , emailusername , phoneusername , typename  
FROM tbuser as u
left join tbhistoryuser as htu on u.userid = htu.userid 
left join tbprefix as p on htu.prefixid = p.prefixid
left join tbfirstname as f on htu.firstnameid = f.firstnameid
left join tblastname as l on htu.lastnameid = l.lastnameid
left join tbcourse as co on u.courseid = co.courseid
left join tbbranch as br on co.branchid = br.branchid
left join tbgroup as gr on br.groupid = gr.groupid
left join tbcampus as ca on gr.campusid = ca.campusid
left join tblogin as lo on u.loginid = lo.loginid
left join tbtype as ty on lo.typeid = ty.typeid
left join tbemailuser as mu on htu.historyuserid = mu.historyuserid
left join tbphoneuser as pu on htu.historyuserid = pu.historyuserid;


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

SELECT u.userid, p.prefixaname, CONCAT(f.firstnamename,' ', l.lastnamename) AS full_name,
       ca.campusname, gr.groupname, br.branchname, co.coursename, emailusername, phoneusername, typename
FROM tbuser AS u
LEFT JOIN (
    SELECT MAX(historyuserid) AS max_historyuserid, userid
    FROM tbhistoryuser
    GROUP BY userid
) AS latest_history ON u.userid = latest_history.userid
LEFT JOIN tbhistoryuser AS htu ON latest_history.max_historyuserid = htu.historyuserid
LEFT JOIN tbprefix AS p ON htu.prefixid = p.prefixid
LEFT JOIN tbfirstname AS f ON htu.firstnameid = f.firstnameid
LEFT JOIN tblastname AS l ON htu.lastnameid = l.lastnameid
LEFT JOIN tbcourse AS co ON u.courseid = co.courseid
LEFT JOIN tbbranch AS br ON co.branchid = br.branchid
LEFT JOIN tbgroup AS gr ON br.groupid = gr.groupid
LEFT JOIN tbcampus AS ca ON gr.campusid = ca.campusid
LEFT JOIN tblogin AS lo ON u.loginid = lo.loginid
LEFT JOIN tbtype AS ty ON lo.typeid = ty.typeid
LEFT JOIN tbemailuser AS mu ON htu.historyuserid = mu.historyuserid
LEFT JOIN tbphoneuser AS pu ON htu.historyuserid = pu.historyuserid
ORDER BY u.userid, htu.historyuserid ;

SELECT u.userid, p.prefixaname, CONCAT(f.firstnamename, ' ', l.lastnamename) AS full_name, co.companyname, co.companyjob, mc.emailcomname, pc.phonecomname
FROM tbuser AS u
LEFT JOIN (
    SELECT MAX(historycomid) AS max_historycomid, userid
    FROM tbhistorycom
    GROUP BY userid
) AS latest_history_com ON u.userid = latest_history_com.userid
LEFT JOIN tbhistorycom AS htc ON latest_history_com.max_historycomid = htc.historycomid
LEFT JOIN (
    SELECT MAX(historyuserid) AS max_historyuserid, userid
    FROM tbhistoryuser
    GROUP BY userid
) AS latest_history_user ON u.userid = latest_history_user.userid
LEFT JOIN tbhistoryuser AS htu ON latest_history_user.max_historyuserid = htu.historyuserid
LEFT JOIN tbprefix AS p ON htu.prefixid = p.prefixid
LEFT JOIN tbfirstname AS f ON htu.firstnameid = f.firstnameid
LEFT JOIN tblastname AS l ON htu.lastnameid = l.lastnameid
LEFT JOIN tbcompany AS co ON htc.companyid = co.companyid
LEFT JOIN tbemailcom AS mc ON co.companyid = mc.companyid
LEFT JOIN tbphonecom AS pc ON co.companyid = pc.companyid
GROUP BY u.userid, htu.historyuserid, htc.historycomid;

 SELECT u.userid, u.loginid, p.prefixaname, f.firstnamename, l.lastnamename ,
    ca.campusname, gr.groupname, br.branchname, co.coursename, emailusername, phoneusername, typename
    FROM tbuser AS u
    LEFT JOIN (
    SELECT MAX(historyuserid) AS max_historyuserid, userid
    FROM tbhistoryuser
    GROUP BY userid
    ) AS latest_history ON u.userid = latest_history.userid
    LEFT JOIN tbhistoryuser AS htu ON latest_history.max_historyuserid = htu.historyuserid
    LEFT JOIN tbprefix AS p ON htu.prefixid = p.prefixid
    LEFT JOIN tbfirstname AS f ON htu.firstnameid = f.firstnameid
    LEFT JOIN tblastname AS l ON htu.lastnameid = l.lastnameid
    LEFT JOIN tbcourse AS co ON u.courseid = co.courseid
    LEFT JOIN tbbranch AS br ON co.branchid = br.branchid
    LEFT JOIN tbgroup AS gr ON br.groupid = gr.groupid
    LEFT JOIN tbcampus AS ca ON gr.campusid = ca.campusid
    LEFT JOIN tblogin AS lo ON u.loginid = lo.loginid
    LEFT JOIN tbtype AS ty ON lo.typeid = ty.typeid
    LEFT JOIN tbemailuser AS mu ON htu.historyuserid = mu.historyuserid
    LEFT JOIN tbphoneuser AS pu ON htu.historyuserid = pu.historyuserid
    WHERE u.userid = '1'
    ORDER BY u.userid, htu.historyuserid ;
    


