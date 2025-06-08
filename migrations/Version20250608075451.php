<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250608075451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE workout (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_649FFB72A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE workout_exercise (id INT AUTO_INCREMENT NOT NULL, workout_id INT NOT NULL, exercise_id INT NOT NULL, sets INT DEFAULT NULL, reps VARCHAR(255) DEFAULT NULL, notes LONGTEXT DEFAULT NULL, order_in_workout INT DEFAULT NULL, INDEX IDX_76AB38AAA6CCCFC9 (workout_id), INDEX IDX_76AB38AAE934951A (exercise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE workout ADD CONSTRAINT FK_649FFB72A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE workout_exercise ADD CONSTRAINT FK_76AB38AAA6CCCFC9 FOREIGN KEY (workout_id) REFERENCES workout (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE workout_exercise ADD CONSTRAINT FK_76AB38AAE934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE workout DROP FOREIGN KEY FK_649FFB72A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE workout_exercise DROP FOREIGN KEY FK_76AB38AAA6CCCFC9
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE workout_exercise DROP FOREIGN KEY FK_76AB38AAE934951A
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE workout
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE workout_exercise
        SQL);
    }
}
