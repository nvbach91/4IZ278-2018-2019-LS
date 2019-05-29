var express = require('express');
var router = express.Router();

var users = {
  '0': { name: 'Bruce', age: 51, salary: 8900 },
  '1': { name: 'Jason', age: 45, salary: 6500 },
  '2': { name: 'Tim', age: 38, salary: 6700 },
  '3': { name: 'Marshall', age: 40, salary: 2900 },
  '4': { name: 'Mike', age: 75, salary: 8500 },
};

router.get('/api/users', function(req, res, next) {
  res.json(users);
});

router.get('/api/users/:id', function(req, res, next) {
  const user = users[req.params.id];
  if (!user) {
    return res.status(404).json({ success: false, msg: 'User not found'});
  }
  res.json(user);
});

router.post('/api/users', function(req, res, next) {
  const { name, age, salary } = req.body;
  var user = {};
  user.name = name;
  user.age = parseInt(age);
  user.salary = parseFloat(salary);
  const id = Object.keys(users).length;
  users[id] = user;
  res.json({ success: true, id: id });
});

router.put('/api/users/:id', function(req, res, next) {
  const user = users[req.params.id];
  if (!user) {
    return res.status(404).json({ success: false, msg: 'User not found'});
  }
  const { name, age, salary } = req.body;
  user.name = name;
  user.age = age;
  user.salary = salary;
  res.json({ success: true });
});

router.delete('/api/users/:id', function(req, res, next) {
  const user = users[req.params.id];
  if (!user) {
    return res.status(404).json({ success: false, msg: 'User not found'});
  }
  delete users[req.params.id];
  res.json({ success: true });
});

module.exports = router;
