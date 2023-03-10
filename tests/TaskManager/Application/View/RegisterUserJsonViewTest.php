<?php
use Ramsey\Uuid\Uuid;
use App\TaskManager\Domain\Entity\User\User;
use App\TaskManager\Domain\Entity\User\UserId;
use App\TaskManager\Domain\Entity\User\UserEmail;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\TaskManager\Application\View\RegisterUserJsonView;
use App\TaskManager\Application\ViewModel\RegisterUserJsonViewModel;

class RegisterUserJsonViewTest extends KernelTestCase
{
    private RegisterUserJsonViewModel $viewModel;
    private RegisterUserJsonView $view;

    public function setUp(): void
    {
        $this->viewModel = $this->createMock(RegisterUserJsonViewModel::class);
        $this->view = new RegisterUserJsonView();
    }

    public function testGenerateViewModel()
    {
        $this->viewModel->errors = ['error'];
        $this->viewModel->userUuid = UserId::fromString(Uuid::uuid4());

        $response = $this->view->generateView($this->viewModel);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertJson($response->getContent());
        $this->assertEquals([
            'response' => [
                'errors' => $this->viewModel->errors,
                'userUuid' => $this->viewModel->userUuid,
            ]
        ], json_decode($response->getContent(), true));

    }
}
?>