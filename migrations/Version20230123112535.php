<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230123112535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE metadata DROP FOREIGN KEY FK_4F143414217BBB47');
        $this->addSql('DROP INDEX IDX_4F143414217BBB47 ON metadata');
        $this->addSql('ALTER TABLE metadata CHANGE person_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE metadata ADD CONSTRAINT FK_4F143414A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_4F143414A76ED395 ON metadata (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE metadata DROP FOREIGN KEY FK_4F143414A76ED395');
        $this->addSql('DROP INDEX IDX_4F143414A76ED395 ON metadata');
        $this->addSql('ALTER TABLE metadata CHANGE user_id person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE metadata ADD CONSTRAINT FK_4F143414217BBB47 FOREIGN KEY (person_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4F143414217BBB47 ON metadata (person_id)');
    }
}
