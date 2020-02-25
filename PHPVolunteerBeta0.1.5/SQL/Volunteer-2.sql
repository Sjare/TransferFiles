CREATE VIEW ActiveVolunteers AS SELECT ln, fn, email, HomePhone, WorkPhone, CellPhone FROM Users WHERE UserStatus = '2';
CREATE VIEW UserWallPosts AS SELECT postID, postBody, postUserID, postDate, ln, fn FROM Wall, Users WHERE postUserID=id AND UserStatus='2';
CREATE VIEW VolHoursPending AS Select User_ID, Hours, Date, ln, fn, Name FROM Hours, Locations, Users WHERE User_ID=id AND LocationID=HoursLocation and HoursStatus = 'Pending';
CREATE VIEW VolHoursVerified AS Select User_ID, Hours, Date, ln, fn, Name FROM Hours, Locations, Users WHERE User_ID=id AND LocationID=HoursLocation and HoursStatus = 'Verified';
CREATE VIEW VolunteerLocations AS Select VIP_ID, LocID, Location, ln, fn, UserStatus, Name FROM LocationAssignments, Users, Locations WHERE Location=LocationID AND VIP_ID=id;
CREATE VIEW ActiveVolsAtLocations AS SELECT Name, COUNT(*) AS Volunteers FROM VolunteerLocations WHERE UserStatus='2' GROUP BY Name ORDER BY Name;
CREATE VIEW usersearch AS SELECT id, ln, fn, email, WorkPhone, HomePhone, CellPhone, concat(fn, ' ', ln, ' ', email, ' ', WorkPhone, ' ', HomePhone, ' ', CellPhone) AS Search FROM Users Where UserStatus = '2' ORDER BY ln;
CREATE VIEW CountActiveMales AS SELECT COUNT(*) AS Males FROM Users WHERE VolunteerGender='Male' AND UserStatus='2';
CREATE VIEW CountActiveFemales AS SELECT COUNT(*) AS Females FROM Users WHERE VolunteerGender='Female' AND UserStatus='2';