const axios = require('axios');
setInterval(function(){
	
	axios({
	  method: 'get',
	  url: 'http://localhost/bot_reactions/sv1.php?cron_type=nodejs',
	}).then(function (response) {
		console.log('\x1b[33m%s\x1b[0m', 'BOT CX SERVER 1 _ RUNNING...');
 	}).catch(error => {
    	console.log('error connect server 1');
	});	
	axios({
	  method: 'get',
	  url: 'http://localhost/bot_reactions/sv2.php?cron_type=nodejs',
	}).then(function (response) {
		console.log('\x1b[33m%s\x1b[0m', 'BOT CX SERVER 2 _ RUNNING...');
 	}).catch(error => {
    	console.log('error connect server 2');
	});

	axios({
	  method: 'get',
	  url: 'http://localhost/bot_reactions_cx/sv1.php?cron_type=nodejs',
	}).then(function (response) {
		console.log('\x1b[33m%s\x1b[0m', 'BOT CX SERVER 1 _ RUNNING...');
 	}).catch(error => {
    	console.log('error connect server 2');
	});


	axios({
	  method: 'get',
	  url: 'http://localhost/bot_reactions_cx/sv2.php?cron_type=nodejs',
	}).then(function (response) {
		console.log('\x1b[33m%s\x1b[0m', 'BOT CX SERVER 2 _ RUNNING...');
 	}).catch(error => {
    	console.log('error connect server 2');
	});

}, 60000);
