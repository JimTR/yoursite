/* this gives posts in a group */
SELECT * , COUNT( posts.post_id ) AS totalp
FROM categories
JOIN topics ON categories.cat_id = topics.topic_cat
JOIN posts ON topics.topic_id = posts.post_topic
WHERE categories.groupid = 8
GROUP BY categories.cat_id
ORDER BY categories.cat_id ASC , posts.post_date DESC 

SELECT * , COUNT( posts.post_id ) AS totalp
FROM categories
JOIN topics ON categories.cat_id = topics.topic_cat
JOIN posts ON topics.topic_id = posts.post_topic
WHERE categories.groupid = 8
GROUP BY categories.cat_id
ORDER BY categories.cat_id ASC ,  posts.post_date DESC 
/* as above but last post selected */ 
SELECT * , COUNT( posts.post_id ) AS totalp
FROM categories
JOIN topics ON categories.cat_id = topics.topic_cat
JOIN posts ON topics.topic_id = posts.post_topic
WHERE categories.groupid =8
GROUP BY categories.cat_id
ORDER BY categories.cat_id ASC , posts.post_id DESC

/*triggers */

/* trigger for user posts */
 
DROP TRIGGER IF EXISTS  `update_posts` ;

CREATE TRIGGER `update_posts` AFTER INSERT ON  `posts` 
FOR EACH
ROW UPDATE users SET postnum = postnum +1 WHERE id = NEW.post_by LIMIT 1

