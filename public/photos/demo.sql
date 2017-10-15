SELECT `t`.`id`       AS `id`,
       `t`.`title`    AS `title_sid`,
       `t`.`body`     AS `body_sid`,
       `src`.`source`     AS `title`,
       `src`.`lang`     AS `lang`,
       (SELECT src2.source FROM sources src2 WHERE src2.code = t.body AND src.lang = src2.lang) as body
FROM   `title` `t`
LEFT JOIN
        sources src
ON
  t.title = src.code AND src.kind = 'webtitle'
