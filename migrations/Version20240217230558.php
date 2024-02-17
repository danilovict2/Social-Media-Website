<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20240217230558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE post_reaction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE post_reaction (id INT NOT NULL, post_id INT NOT NULL, created_by_id INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1B3A8E564B89032C ON post_reaction (post_id)');
        $this->addSql('CREATE INDEX IDX_1B3A8E56B03A8386 ON post_reaction (created_by_id)');
        $this->addSql('ALTER TABLE post_reaction ADD CONSTRAINT FK_1B3A8E564B89032C FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_reaction ADD CONSTRAINT FK_1B3A8E56B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE post_reaction_id_seq CASCADE');
        $this->addSql('ALTER TABLE post_reaction DROP CONSTRAINT FK_1B3A8E564B89032C');
        $this->addSql('ALTER TABLE post_reaction DROP CONSTRAINT FK_1B3A8E56B03A8386');
        $this->addSql('DROP TABLE post_reaction');
    }
}
