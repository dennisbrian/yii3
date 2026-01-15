<?php

declare(strict_types=1);

namespace App\Console;

use App\User\IdentityRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Create Admin User Console Command
 * 
 * Usage: ./yii user:create-admin <email> <password>
 * 
 * This command:
 * 1. Creates a new user in the database
 * 2. Assigns the 'admin' role via RBAC
 */
final class CreateAdminCommand extends Command
{
    protected static $defaultName = 'user:create-admin';
    protected static $defaultDescription = 'Create an admin user with password';
    
    public function __construct(
        private readonly IdentityRepository $identityRepository,
    ) {
        parent::__construct();
    }
    
    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Admin email address')
            ->addArgument('password', InputArgument::REQUIRED, 'Admin password')
            ->addArgument('username', InputArgument::OPTIONAL, 'Username (defaults to email prefix)');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $username = $input->getArgument('username') ?? explode('@', $email)[0];
        
        $io->title('Creating Admin User');
        
        // Check if user already exists
        $existing = $this->identityRepository->findByEmail($email);
        if ($existing !== null) {
            $io->error("User with email '$email' already exists!");
            return Command::FAILURE;
        }
        
        // Create user
        try {
            $identity = $this->identityRepository->create($username, $email, $password);
            $userId = $identity->getId();
            
            $io->success([
                "Admin user created successfully!",
                "User ID: $userId",
                "Email: $email",
                "Username: $username",
            ]);
            
            // Update RBAC assignments file
            $this->assignAdminRole($userId);
            $io->note("Admin role assigned via RBAC");
            
            $io->section('Next Steps');
            $io->listing([
                "Go to http://localhost:8000/login",
                "Login with: $email / $password",
                "You will be redirected to the dashboard",
            ]);
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error("Failed to create user: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
    
    private function assignAdminRole(string $userId): void
    {
        $assignmentsFile = dirname(__DIR__, 2) . '/rbac/assignments.php';
        
        // Read current assignments
        $content = file_get_contents($assignmentsFile);
        
        // Add new assignment
        $newContent = str_replace(
            "'assignments' => [",
            "'assignments' => [\n        '$userId' => ['admin'],",
            $content
        );
        
        file_put_contents($assignmentsFile, $newContent);
    }
}
