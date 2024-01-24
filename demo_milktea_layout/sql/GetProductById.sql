SELECT
    p.product_id,
    p.name,
    p.category_id,
    c.name as category_name,
    p.price,
    p.description,
    p.image_url
FROM
    product AS p
INNER JOIN category AS c
    ON c.category_id = p.category_id
WHERE
    p.product_id = :product_id;