CREATE TABLE /*TABLE_PREFIX*/t_seo_item_meta_fields (
    fk_i_item_id INT(10) UNSIGNED NOT NULL,
    seo_item_meta_title VARCHAR(55) NULL,
    seo_item_meta_title_format VARCHAR(55) NULL,
    seo_item_meta_description VARCHAR(155) NULL,
    seo_item_meta_keywords VARCHAR(155) NULL,

    PRIMARY KEY (fk_i_item_id)
) ENGINE=InnoDB DEFAULT CHARACTER SET 'UTF8' COLLATE 'UTF8_GENERAL_CI' ;

