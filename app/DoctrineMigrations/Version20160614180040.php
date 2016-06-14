<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160614180040 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE fos_user_user_group (user_id INTEGER NOT NULL, group_id INTEGER NOT NULL, PRIMARY KEY(user_id, group_id))');
        $this->addSql('CREATE INDEX IDX_B3C77447A76ED395 ON fos_user_user_group (user_id)');
        $this->addSql('CREATE INDEX IDX_B3C77447FE54D947 ON fos_user_user_group (group_id)');
        $this->addSql('DROP INDEX IDX_5A8A6C8D12469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, category_id, title, content, image FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER NOT NULL, category_id INTEGER DEFAULT NULL, title VARCHAR(100) NOT NULL COLLATE BINARY, content CLOB DEFAULT NULL COLLATE BINARY, image VARCHAR(255) DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_5A8A6C8D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO post (id, category_id, title, content, image) SELECT id, category_id, title, content, image FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D12469DE2 ON post (category_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649A0D96FBF');
        $this->addSql('DROP INDEX UNIQ_8D93D64992FC23A8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER NOT NULL, username VARCHAR(255) NOT NULL COLLATE BINARY, username_canonical VARCHAR(255) NOT NULL COLLATE BINARY, email VARCHAR(255) NOT NULL COLLATE BINARY, email_canonical VARCHAR(255) NOT NULL COLLATE BINARY, enabled BOOLEAN NOT NULL, salt VARCHAR(255) NOT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY, last_login DATETIME DEFAULT NULL, locked BOOLEAN NOT NULL, expired BOOLEAN NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL COLLATE BINARY, password_requested_at DATETIME DEFAULT NULL, credentials_expired BOOLEAN NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, date_of_birth DATETIME DEFAULT NULL, firstname VARCHAR(64) DEFAULT NULL COLLATE BINARY, lastname VARCHAR(64) DEFAULT NULL COLLATE BINARY, website VARCHAR(64) DEFAULT NULL COLLATE BINARY, biography VARCHAR(1000) DEFAULT NULL COLLATE BINARY, gender VARCHAR(1) DEFAULT NULL COLLATE BINARY, locale VARCHAR(8) DEFAULT NULL COLLATE BINARY, timezone VARCHAR(64) DEFAULT NULL COLLATE BINARY, phone VARCHAR(64) DEFAULT NULL COLLATE BINARY, facebook_uid VARCHAR(255) DEFAULT NULL COLLATE BINARY, facebook_name VARCHAR(255) DEFAULT NULL COLLATE BINARY, twitter_uid VARCHAR(255) DEFAULT NULL COLLATE BINARY, twitter_name VARCHAR(255) DEFAULT NULL COLLATE BINARY, gplus_uid VARCHAR(255) DEFAULT NULL COLLATE BINARY, gplus_name VARCHAR(255) DEFAULT NULL COLLATE BINARY, token VARCHAR(255) DEFAULT NULL COLLATE BINARY, two_step_code VARCHAR(255) DEFAULT NULL COLLATE BINARY, roles CLOB NOT NULL, facebook_data CLOB DEFAULT NULL, twitter_data CLOB DEFAULT NULL, gplus_data CLOB DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code) SELECT id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A0D96FBF ON user (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64992FC23A8 ON user (username_canonical)');
        $this->addSql('DROP INDEX UNIQ_8F02BF9D5E237E06');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_group AS SELECT id, name, roles FROM user_group');
        $this->addSql('DROP TABLE user_group');
        $this->addSql('CREATE TABLE user_group (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, roles CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO user_group (id, name, roles) SELECT id, name, roles FROM __temp__user_group');
        $this->addSql('DROP TABLE __temp__user_group');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F02BF9D5E237E06 ON user_group (name)');
        $this->addSql('DROP INDEX IDX_9407E54977FA751A');
        $this->addSql('DROP INDEX UNIQ_9407E5494B12AD6EA000B10');
        $this->addSql('CREATE TEMPORARY TABLE __temp__acl_object_identities AS SELECT id, parent_object_identity_id, class_id, object_identifier, entries_inheriting FROM acl_object_identities');
        $this->addSql('DROP TABLE acl_object_identities');
        $this->addSql('CREATE TABLE acl_object_identities (id INTEGER NOT NULL, parent_object_identity_id INTEGER UNSIGNED DEFAULT NULL, class_id INTEGER UNSIGNED NOT NULL, object_identifier VARCHAR(100) NOT NULL COLLATE BINARY, entries_inheriting BOOLEAN NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_9407E54977FA751A FOREIGN KEY (parent_object_identity_id) REFERENCES acl_object_identities (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO acl_object_identities (id, parent_object_identity_id, class_id, object_identifier, entries_inheriting) SELECT id, parent_object_identity_id, class_id, object_identifier, entries_inheriting FROM __temp__acl_object_identities');
        $this->addSql('DROP TABLE __temp__acl_object_identities');
        $this->addSql('CREATE INDEX IDX_9407E54977FA751A ON acl_object_identities (parent_object_identity_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9407E5494B12AD6EA000B10 ON acl_object_identities (object_identifier, class_id)');
        $this->addSql('DROP INDEX IDX_825DE299C671CEA1');
        $this->addSql('DROP INDEX IDX_825DE2993D9AB4A6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__acl_object_identity_ancestors AS SELECT object_identity_id, ancestor_id FROM acl_object_identity_ancestors');
        $this->addSql('DROP TABLE acl_object_identity_ancestors');
        $this->addSql('CREATE TABLE acl_object_identity_ancestors (object_identity_id INTEGER UNSIGNED NOT NULL, ancestor_id INTEGER UNSIGNED NOT NULL, PRIMARY KEY(object_identity_id, ancestor_id), CONSTRAINT FK_825DE2993D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_825DE299C671CEA1 FOREIGN KEY (ancestor_id) REFERENCES acl_object_identities (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO acl_object_identity_ancestors (object_identity_id, ancestor_id) SELECT object_identity_id, ancestor_id FROM __temp__acl_object_identity_ancestors');
        $this->addSql('DROP TABLE __temp__acl_object_identity_ancestors');
        $this->addSql('CREATE INDEX IDX_825DE299C671CEA1 ON acl_object_identity_ancestors (ancestor_id)');
        $this->addSql('CREATE INDEX IDX_825DE2993D9AB4A6 ON acl_object_identity_ancestors (object_identity_id)');
        $this->addSql('DROP INDEX IDX_46C8B806DF9183C9');
        $this->addSql('DROP INDEX IDX_46C8B8063D9AB4A6');
        $this->addSql('DROP INDEX IDX_46C8B806EA000B10');
        $this->addSql('DROP INDEX IDX_46C8B806EA000B103D9AB4A6DF9183C9');
        $this->addSql('DROP INDEX UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__acl_entries AS SELECT id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure FROM acl_entries');
        $this->addSql('DROP TABLE acl_entries');
        $this->addSql('CREATE TABLE acl_entries (id INTEGER NOT NULL, class_id INTEGER UNSIGNED NOT NULL, object_identity_id INTEGER UNSIGNED DEFAULT NULL, security_identity_id INTEGER UNSIGNED NOT NULL, field_name VARCHAR(50) DEFAULT NULL COLLATE BINARY, ace_order SMALLINT UNSIGNED NOT NULL, mask INTEGER NOT NULL, granting BOOLEAN NOT NULL, granting_strategy VARCHAR(30) NOT NULL COLLATE BINARY, audit_success BOOLEAN NOT NULL, audit_failure BOOLEAN NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_46C8B806EA000B10 FOREIGN KEY (class_id) REFERENCES acl_classes (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_46C8B8063D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_46C8B806DF9183C9 FOREIGN KEY (security_identity_id) REFERENCES acl_security_identities (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) SELECT id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure FROM __temp__acl_entries');
        $this->addSql('DROP TABLE __temp__acl_entries');
        $this->addSql('CREATE INDEX IDX_46C8B806DF9183C9 ON acl_entries (security_identity_id)');
        $this->addSql('CREATE INDEX IDX_46C8B8063D9AB4A6 ON acl_entries (object_identity_id)');
        $this->addSql('CREATE INDEX IDX_46C8B806EA000B10 ON acl_entries (class_id)');
        $this->addSql('CREATE INDEX IDX_46C8B806EA000B103D9AB4A6DF9183C9 ON acl_entries (class_id, object_identity_id, security_identity_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4 ON acl_entries (class_id, object_identity_id, field_name, ace_order)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE fos_user_user_group');
        $this->addSql('DROP INDEX UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4');
        $this->addSql('DROP INDEX IDX_46C8B806EA000B103D9AB4A6DF9183C9');
        $this->addSql('DROP INDEX IDX_46C8B806EA000B10');
        $this->addSql('DROP INDEX IDX_46C8B8063D9AB4A6');
        $this->addSql('DROP INDEX IDX_46C8B806DF9183C9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__acl_entries AS SELECT id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure FROM acl_entries');
        $this->addSql('DROP TABLE acl_entries');
        $this->addSql('CREATE TABLE acl_entries (id INTEGER NOT NULL, class_id INTEGER UNSIGNED NOT NULL, object_identity_id INTEGER UNSIGNED DEFAULT NULL, security_identity_id INTEGER UNSIGNED NOT NULL, field_name VARCHAR(50) DEFAULT NULL, ace_order SMALLINT UNSIGNED NOT NULL, mask INTEGER NOT NULL, granting BOOLEAN NOT NULL, granting_strategy VARCHAR(30) NOT NULL, audit_success BOOLEAN NOT NULL, audit_failure BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) SELECT id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure FROM __temp__acl_entries');
        $this->addSql('DROP TABLE __temp__acl_entries');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4 ON acl_entries (class_id, object_identity_id, field_name, ace_order)');
        $this->addSql('CREATE INDEX IDX_46C8B806EA000B103D9AB4A6DF9183C9 ON acl_entries (class_id, object_identity_id, security_identity_id)');
        $this->addSql('CREATE INDEX IDX_46C8B806EA000B10 ON acl_entries (class_id)');
        $this->addSql('CREATE INDEX IDX_46C8B8063D9AB4A6 ON acl_entries (object_identity_id)');
        $this->addSql('CREATE INDEX IDX_46C8B806DF9183C9 ON acl_entries (security_identity_id)');
        $this->addSql('DROP INDEX UNIQ_9407E5494B12AD6EA000B10');
        $this->addSql('DROP INDEX IDX_9407E54977FA751A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__acl_object_identities AS SELECT id, parent_object_identity_id, class_id, object_identifier, entries_inheriting FROM acl_object_identities');
        $this->addSql('DROP TABLE acl_object_identities');
        $this->addSql('CREATE TABLE acl_object_identities (id INTEGER NOT NULL, parent_object_identity_id INTEGER UNSIGNED DEFAULT NULL, class_id INTEGER UNSIGNED NOT NULL, object_identifier VARCHAR(100) NOT NULL, entries_inheriting BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO acl_object_identities (id, parent_object_identity_id, class_id, object_identifier, entries_inheriting) SELECT id, parent_object_identity_id, class_id, object_identifier, entries_inheriting FROM __temp__acl_object_identities');
        $this->addSql('DROP TABLE __temp__acl_object_identities');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9407E5494B12AD6EA000B10 ON acl_object_identities (object_identifier, class_id)');
        $this->addSql('CREATE INDEX IDX_9407E54977FA751A ON acl_object_identities (parent_object_identity_id)');
        $this->addSql('DROP INDEX IDX_825DE2993D9AB4A6');
        $this->addSql('DROP INDEX IDX_825DE299C671CEA1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__acl_object_identity_ancestors AS SELECT object_identity_id, ancestor_id FROM acl_object_identity_ancestors');
        $this->addSql('DROP TABLE acl_object_identity_ancestors');
        $this->addSql('CREATE TABLE acl_object_identity_ancestors (object_identity_id INTEGER UNSIGNED NOT NULL, ancestor_id INTEGER UNSIGNED NOT NULL, PRIMARY KEY(object_identity_id, ancestor_id))');
        $this->addSql('INSERT INTO acl_object_identity_ancestors (object_identity_id, ancestor_id) SELECT object_identity_id, ancestor_id FROM __temp__acl_object_identity_ancestors');
        $this->addSql('DROP TABLE __temp__acl_object_identity_ancestors');
        $this->addSql('CREATE INDEX IDX_825DE2993D9AB4A6 ON acl_object_identity_ancestors (object_identity_id)');
        $this->addSql('CREATE INDEX IDX_825DE299C671CEA1 ON acl_object_identity_ancestors (ancestor_id)');
        $this->addSql('DROP INDEX IDX_5A8A6C8D12469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__post AS SELECT id, category_id, title, content, image FROM post');
        $this->addSql('DROP TABLE post');
        $this->addSql('CREATE TABLE post (id INTEGER NOT NULL, category_id INTEGER DEFAULT NULL, title VARCHAR(100) NOT NULL, content CLOB DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO post (id, category_id, title, content, image) SELECT id, category_id, title, content, image FROM __temp__post');
        $this->addSql('DROP TABLE __temp__post');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D12469DE2 ON post (category_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D64992FC23A8');
        $this->addSql('DROP INDEX UNIQ_8D93D649A0D96FBF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked BOOLEAN NOT NULL, expired BOOLEAN NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, credentials_expired BOOLEAN NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, date_of_birth DATETIME DEFAULT NULL, firstname VARCHAR(64) DEFAULT NULL, lastname VARCHAR(64) DEFAULT NULL, website VARCHAR(64) DEFAULT NULL, biography VARCHAR(1000) DEFAULT NULL, gender VARCHAR(1) DEFAULT NULL, locale VARCHAR(8) DEFAULT NULL, timezone VARCHAR(64) DEFAULT NULL, phone VARCHAR(64) DEFAULT NULL, facebook_uid VARCHAR(255) DEFAULT NULL, facebook_name VARCHAR(255) DEFAULT NULL, twitter_uid VARCHAR(255) DEFAULT NULL, twitter_name VARCHAR(255) DEFAULT NULL, gplus_uid VARCHAR(255) DEFAULT NULL, gplus_name VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, two_step_code VARCHAR(255) DEFAULT NULL, roles CLOB NOT NULL COLLATE BINARY, facebook_data CLOB DEFAULT NULL COLLATE BINARY, twitter_data CLOB DEFAULT NULL COLLATE BINARY, gplus_data CLOB DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code) SELECT id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, created_at, updated_at, date_of_birth, firstname, lastname, website, biography, gender, locale, timezone, phone, facebook_uid, facebook_name, facebook_data, twitter_uid, twitter_name, twitter_data, gplus_uid, gplus_name, gplus_data, token, two_step_code FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64992FC23A8 ON user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A0D96FBF ON user (email_canonical)');
        $this->addSql('DROP INDEX UNIQ_8F02BF9D5E237E06');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_group AS SELECT id, name, roles FROM user_group');
        $this->addSql('DROP TABLE user_group');
        $this->addSql('CREATE TABLE user_group (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, roles CLOB NOT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO user_group (id, name, roles) SELECT id, name, roles FROM __temp__user_group');
        $this->addSql('DROP TABLE __temp__user_group');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F02BF9D5E237E06 ON user_group (name)');
    }
}
