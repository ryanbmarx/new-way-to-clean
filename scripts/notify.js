const fs = require('fs');
const notifier = require('node-notifier');

const notificationHeadline = process.argv[2],
	notificationText = process.argv[3] ? process.argv[3] : "";

notifier.notify({
  title: notificationHeadline,
  message: notificationText
}, function (err, response) {
  // Response is response from notification 
});