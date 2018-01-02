const 	fs = require('fs'),
		SFTPClient = require('sftp-promises'),
		config = {
			host: 'ftp.wpsupporthq.com', 
			username: 'newwaytoclean', 
			password: 'b%2g7b8CBjen*6Wc' 
		},
		remotePath="//home/newwaytoclean/public_html/wp-content/themes/MSDivi",
		// //home/newwaytoclean/public_html/wp-content/themes/MSDivi
		// sftp://ftp.wpsupporthq.com//home/newwaytoclean/public_html/wp-content/themes/MSDivi
		localPath="/Users/ryanbmarx/Google Drive/Media Salad/norwex/2015/we-NewWayToClean/web_publish",

		sftp = new SFTPClient(config);

var filesToUpload = [];

process.argv.forEach((v, i) => {
	// Cycle through the arguments passed arguments and add them to the list
	// TO DO, add check for desired file types?
	// TO DO, look for dirs
	if (i > 1){
		filesToUpload.push(v);
	}
});


console.log("Uploading", filesToUpload);

filesToUpload.forEach(file => {
	sftp.put(`${localPath}/${file}`, `${remotePath}/${file}`)
		.then(function(success){
			if (success) console.log(`Uploaded ${file}`);
			else console.log(`Error uploading ${file}`);
		})

})
