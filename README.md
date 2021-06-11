# users
Сделал пока генератор пользователей и запросы в БД

на генератор потрачено было 3 часа

на запросы 1 час.

Сами запросы:


SELECT u.name, SUM(IF(u.id=up.users_id, up.balance,0)) as total_summ  FROM users u LEFT JOIN users_phones up on u.id = up.users_id group by u.id;

SELECT up.code_operator, COUNT(up.code_operator) as counts FROM users_phones up group by code_operator;

SELECT u.name, COUNT(up.phone) FROM users u LEFT JOIN users_phones up on u.id = up.users_id group by u.id;

SELECT u.name FROM users u LEFT JOIN users_phones up on u.id = up.users_id ORDER BY up.balance DESC LIMIT 10
