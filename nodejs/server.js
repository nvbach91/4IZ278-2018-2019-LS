require('http').createServer((req, res) => {
  res.write('<h1>Hi!<h1>');
  res.end();
}).listen(9000, () => {
  console.log('Server running');
});