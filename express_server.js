const express = require('express');
const app = express();
const path    = require("path");
const fs = require("fs");
const mysql = require('mysql');

const con = mysql.createConnection({
	host: "localhost",
	user: "root",
	password: "",
	database: "mydb",
});

con.connect(function(err) {
	if (err) throw err;
	console.log("Connected!");
	const sql_db = "CREATE DATABASE IF NOT EXISTS mydb";
	con.query(sql_db, function (err, result) {
		if (err) throw err;
		console.log("Database created");
	});

	const sql_comments = "CREATE TABLE IF NOT EXISTS comments (comment_id INT PRIMARY KEY AUTO_INCREMENT, post_id INT NOT NULL, by_user TEXT, message TEXT, data_time TIMESTAMP, likes INT NOT NULL)";
	con.query(sql_comments, function (err, result) {
		if (err) throw err;
		console.log("Table comments created");
	});

	const sql_post = "CREATE TABLE IF NOT EXISTS post (id INT PRIMARY KEY AUTO_INCREMENT, title TEXT, description TEXT, url TEXT, likes INT NOT NULL, post_by TEXT)";
	con.query(sql_post, function (err, result) {
		if (err) throw err;
		console.log("Table post created");
	});

	const sql_tag_list = "CREATE TABLE IF NOT EXISTS tag_list (id INT PRIMARY KEY AUTO_INCREMENT, post_id INT NOT NULL, tag TEXT)";
	con.query(sql_tag_list, function (err, result) {
		if (err) throw err;
		console.log("Table tag_list created");
	});
});

app.use(express.static('MyRepo'));

app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname+'/mysite.html'));
});

app.get('/site', (req, res) => {
    res.sendFile(path.join(__dirname+'/mysite2.html'));
});

app.get('/file', (req, res) => {
		fs.readFile('myfile.txt', 'utf8', function(err, contents) {
		res.send(contents);
	});
})

app.get('/api', (req, res) => {
  res.statusCode = 302;
  res.setHeader("Location", "http://www.google.com");
  res.end();
});

app.get('/ajax', (req, res) => {
  res.sendFile(path.join(__dirname+'/mysitewithajax.html'));
});

app.get('/post', (req, res) => {
	con.query('SELECT * FROM post', (error, result) => {
        if (error) throw error;
		
        res.send(result);
    });
});

app.get('/post/:id', (req, res) => {
	const id = req.params.id;
 
    con.query('SELECT * FROM post WHERE id = ?', id, (error, result) => {
        if (error) throw error;
 
        res.send(result);
    });
});
app.get('/single_post/:title', (req, res) => {
	const title = req.params.title;
 
    con.query('SELECT description FROM post WHERE title = ?', title, (error, result) => {
        if (error) throw error;
 
        res.send(result);
    });
});
app.listen(3000, () => console.log('Gator app listening on port 3000!'));