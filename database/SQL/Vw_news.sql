SELECT
  news.id AS id,
  news.title_sid AS title_sid,
  news.content_sid AS content_sid,
  news.thumbnail AS thumbnail,
  news.slide AS slide,
  news.have_comment AS have_comment,
  news.active_flag AS active_flag,
  news.insert_user AS insert_user,
  news.insert_date AS insert_date,
  news.update_user AS update_user,
  news.update_date AS update_date,
  s1.source_id AS source_id,
  s1.source AS source,
  s1.lang AS lang,
  s1.kind AS kind,
  s1.code AS code,
  cat1.cat_id AS cat_id,
  (SELECT sources.source FROM sources WHERE sources.code = news.title_sid AND sources.lang = s1.lang) AS title,
  (SELECT vw_category.source FROM vw_category WHERE vw_category.ca_id = cat1.cat_id AND vw_category.lang = s1.lang) AS ca_title
FROM
  news
LEFT JOIN sources s1 ON news.content_sid = s1.code AND s1.kind = 'news'
LEFT JOIN news_cat cat1 ON news.id = cat1.news_id
