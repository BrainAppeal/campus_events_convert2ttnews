#
# Table structure for table 'tx_news_domain_model_news'
#
CREATE TABLE tt_news (
	ce_import_source varchar(255) DEFAULT NULL,
	ce_import_id int(11) unsigned DEFAULT NULL ,
	ce_imported_at int(11) unsigned DEFAULT NULL
);

#
# Table structure for table 'tx_campuseventsconnector_domain_model_convertconfiguration'
#
CREATE TABLE tx_campuseventsconnector_domain_model_convertconfiguration (

	ttnews_type int(11) DEFAULT '0' NOT NULL

);
