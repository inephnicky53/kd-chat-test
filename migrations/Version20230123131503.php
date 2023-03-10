<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230123131503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE thread_user (thread_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_922CAC7E2904019 (thread_id), INDEX IDX_922CAC7A76ED395 (user_id), PRIMARY KEY(thread_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE thread_user ADD CONSTRAINT FK_922CAC7E2904019 FOREIGN KEY (thread_id) REFERENCES thread (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE thread_user ADD CONSTRAINT FK_922CAC7A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_thread DROP FOREIGN KEY FK_547257BEA76ED395');
        $this->addSql('ALTER TABLE user_thread DROP FOREIGN KEY FK_547257BEE2904019');
        $this->addSql('DROP TABLE user_thread');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_thread (user_id INT NOT NULL, thread_id INT NOT NULL, INDEX IDX_547257BEA76ED395 (user_id), INDEX IDX_547257BEE2904019 (thread_id), PRIMARY KEY(user_id, thread_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_thread ADD CONSTRAINT FK_547257BEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_thread ADD CONSTRAINT FK_547257BEE2904019 FOREIGN KEY (thread_id) REFERENCES thread (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE thread_user DROP FOREIGN KEY FK_922CAC7E2904019');
        $this->addSql('ALTER TABLE thread_user DROP FOREIGN KEY FK_922CAC7A76ED395');
        $this->addSql('DROP TABLE thread_user');
    }
}
