<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929075815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ticketing_ticket (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, summary VARCHAR(255) NOT NULL, content CLOB NOT NULL, published_at DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_A4AE5A51F675F31B ON ticketing_ticket (author_id)');
        $this->addSql('DROP TABLE symfony_demo_post');
        $this->addSql('DROP INDEX IDX_C7F4CFABF675F31B');
        $this->addSql('DROP INDEX IDX_C7F4CFAB4B89032C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ticketing_comment AS SELECT id, post_id, author_id, content, published_at FROM ticketing_comment');
        $this->addSql('DROP TABLE ticketing_comment');
        $this->addSql('CREATE TABLE ticketing_comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, post_id INTEGER NOT NULL, author_id INTEGER NOT NULL, content CLOB NOT NULL, published_at DATETIME NOT NULL, CONSTRAINT FK_C7F4CFAB4B89032C FOREIGN KEY (post_id) REFERENCES ticketing_ticket (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C7F4CFABF675F31B FOREIGN KEY (author_id) REFERENCES symfony_demo_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ticketing_comment (id, post_id, author_id, content, published_at) SELECT id, post_id, author_id, content, published_at FROM __temp__ticketing_comment');
        $this->addSql('DROP TABLE __temp__ticketing_comment');
        $this->addSql('CREATE INDEX IDX_C7F4CFABF675F31B ON ticketing_comment (author_id)');
        $this->addSql('CREATE INDEX IDX_C7F4CFAB4B89032C ON ticketing_comment (post_id)');
        $this->addSql('DROP INDEX IDX_6ABC1CC44B89032C');
        $this->addSql('DROP INDEX IDX_6ABC1CC4BAD26311');
        $this->addSql('CREATE TEMPORARY TABLE __temp__symfony_demo_post_tag AS SELECT post_id, tag_id FROM symfony_demo_post_tag');
        $this->addSql('DROP TABLE symfony_demo_post_tag');
        $this->addSql('CREATE TABLE symfony_demo_post_tag (ticket_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(ticket_id, tag_id), CONSTRAINT FK_6ABC1CC4700047D2 FOREIGN KEY (ticket_id) REFERENCES ticketing_ticket (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6ABC1CC4BAD26311 FOREIGN KEY (tag_id) REFERENCES symfony_demo_tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO symfony_demo_post_tag (ticket_id, tag_id) SELECT post_id, tag_id FROM __temp__symfony_demo_post_tag');
        $this->addSql('DROP TABLE __temp__symfony_demo_post_tag');
        $this->addSql('CREATE INDEX IDX_6ABC1CC4BAD26311 ON symfony_demo_post_tag (tag_id)');
        $this->addSql('CREATE INDEX IDX_6ABC1CC4700047D2 ON symfony_demo_post_tag (ticket_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE symfony_demo_post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL COLLATE BINARY, summary VARCHAR(255) NOT NULL COLLATE BINARY, content CLOB NOT NULL COLLATE BINARY, published_at DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_58A92E65F675F31B ON symfony_demo_post (author_id)');
        $this->addSql('DROP TABLE ticketing_ticket');
        $this->addSql('DROP INDEX IDX_6ABC1CC4700047D2');
        $this->addSql('DROP INDEX IDX_6ABC1CC4BAD26311');
        $this->addSql('CREATE TEMPORARY TABLE __temp__symfony_demo_post_tag AS SELECT ticket_id, tag_id FROM symfony_demo_post_tag');
        $this->addSql('DROP TABLE symfony_demo_post_tag');
        $this->addSql('CREATE TABLE symfony_demo_post_tag (post_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(post_id, tag_id), CONSTRAINT FK_6ABC1CC4700047D2 FOREIGN KEY (post_id) REFERENCES ticketing_ticket (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO symfony_demo_post_tag (post_id, tag_id) SELECT ticket_id, tag_id FROM __temp__symfony_demo_post_tag');
        $this->addSql('DROP TABLE __temp__symfony_demo_post_tag');
        $this->addSql('CREATE INDEX IDX_6ABC1CC4BAD26311 ON symfony_demo_post_tag (tag_id)');
        $this->addSql('CREATE INDEX IDX_6ABC1CC44B89032C ON symfony_demo_post_tag (post_id)');
        $this->addSql('DROP INDEX IDX_C7F4CFAB4B89032C');
        $this->addSql('DROP INDEX IDX_C7F4CFABF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ticketing_comment AS SELECT id, post_id, author_id, content, published_at FROM ticketing_comment');
        $this->addSql('DROP TABLE ticketing_comment');
        $this->addSql('CREATE TABLE ticketing_comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, post_id INTEGER NOT NULL, author_id INTEGER NOT NULL, content CLOB NOT NULL, published_at DATETIME NOT NULL, CONSTRAINT FK_C7F4CFAB4B89032C FOREIGN KEY (post_id) REFERENCES ticketing_ticket (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ticketing_comment (id, post_id, author_id, content, published_at) SELECT id, post_id, author_id, content, published_at FROM __temp__ticketing_comment');
        $this->addSql('DROP TABLE __temp__ticketing_comment');
        $this->addSql('CREATE INDEX IDX_C7F4CFAB4B89032C ON ticketing_comment (post_id)');
        $this->addSql('CREATE INDEX IDX_C7F4CFABF675F31B ON ticketing_comment (author_id)');
    }
}
