const express = require('express');
const path = require('path');

const app = express();
app.use(express.static(path.resolve(__dirname, 'public')));
app.get('*', function (request, response) {
  response.sendFile(path.resolve(__dirname, 'public', 'index.html'))
});

const port = process.env.PORT || 80;
app.listen(port);
console.log('Server started on port ' + port);
