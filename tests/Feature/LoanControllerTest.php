<?php

namespace Tests\Feature;

use App\Models\Loan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoanControllerTest extends TestCase
{
    private $userAuthToken = 'd05620f71a677c2acc6b4ab2f6e11134';
    private $managerAuthToken = 'ea0b77d84d5064283bb9daef4af7df5d';
    private $loanIdToBeApproved;

    protected $appHeaders = [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ',
    ];

    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->appHeaders['Authorization'] = 'Bearer ' . $this->userAuthToken;
    }

    public function testAuthTokenForRequestLoan()
    {
        $appHeaders['Authorization'] = 'Bearer ' . 'someRandomToken';
        $query = [
            'loanAmount' => 1000,
            'loanTerm' => 3
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/request-loan', $query);
        $response->assertStatus(401);
    }

    public function testManagerAuthTokenForRequestLoan()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->managerAuthToken;
        $query = [
            'loanAmount' => 1000,
            'loanTerm' => 3
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/request-loan', $query);
        $response->assertStatus(403);
    }

    public function testInvalidAmountForRequestLoan()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->userAuthToken;
        $query = [
            'loanAmount' => -1000,
            'loanTerm' => 3
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/request-loan', $query);
        $response->assertStatus(400);
    }

    public function testInvalidTermForRequestLoan()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->userAuthToken;
        $query = [
            'loanAmount' => 1000,
            'loanTerm' => 'abc'
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/request-loan', $query);
        $response->assertStatus(400);
    }

    public function testMissingLoanAmountForRequestLoan()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->userAuthToken;
        $query = [
            'loanTerm' => 1
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/request-loan', $query);
        $response->assertStatus(400);
    }

    public function testMissingLoanTermForRequestLoan()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->userAuthToken;
        $query = [
            'loanAmount' => 1000
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/request-loan', $query);
        $response->assertStatus(400);
    }

    public function testValidRequestLoan()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->userAuthToken;
        $query = [
            'loanAmount' => 1000,
            'loanTerm' => 3
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/request-loan', $query);
        $response->assertStatus(200);
    }


    public function testLoanListForUser()
    {
        $this->appHeaders['Authorization'] = 'Bearer ' . $this->userAuthToken;

        $response = $this
            ->withHeaders($this->appHeaders)
            ->json('GET', '/api/loan-list-by-user');
        $response->assertStatus(200);
    }

    public function testInvalidAuthTokenForLoanList()
    {
        $this->appHeaders['Authorization'] = 'Bearer ' . 'SomeRandomKey';
        $response = $this
            ->withHeaders($this->appHeaders)
            ->json('GET', '/api/loan-list-by-user');
        $response->assertStatus(401);
    }

    public function testAuthTokenForChangeLoanStatus()
    {
        $appHeaders['Authorization'] = 'Bearer ' . 'someRandomToken';
        $query = [
            'approvedAmount' => 1000,
            'loanStatus' => 1
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/change-loan-status', $query);
        $response->assertStatus(401);
    }

    public function testUserAuthTokenForChangeLoanStatus()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->userAuthToken;
        $query = [
            'approvedAmount' => 1000,
            'loanStatus' => 1
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/change-loan-status', $query);
        $response->assertStatus(403);
    }

    public function testInvalidAmountForChangeLoanStatus()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->managerAuthToken;
        $query = [
            'approvedAmount' => '1000aa',
            'loanStatus' => 1,
            'loadId' => 1
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/change-loan-status', $query);
        $response->assertStatus(400);
    }

    public function testInvalidLoanStatusForChangeLoanStatus()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->managerAuthToken;
        $query = [
            'approvedAmount' => 1000,
            'loanStatus' => 3,
            'loadId' => 1
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/change-loan-status', $query);
        $response->assertStatus(400);
    }

    public function testMissingLoanIdForChangeLoanStatus()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->managerAuthToken;
        $query = [
            'approvedAmount' => 1000,
            'loanStatus' => 3,
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/change-loan-status', $query);
        $response->assertStatus(400);
    }

    public function testMissingLoanStatusForChangeLoanStatus()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->managerAuthToken;
        $query = [
            'approvedAmount' => 1000,
            'loanId' => 3,
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/change-loan-status', $query);
        $response->assertStatus(400);
    }

    public function testAlreadyProcessedLoan()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->managerAuthToken;
        $query = [
            'approvedAmount' => 1000,
            'loanStatus' => 1,
            'loanId' => 1
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/change-loan-status', $query);

        $response->assertStatus(409);
    }

    public function testMissingLoanDetails()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->managerAuthToken;
        $query = [
            'approvedAmount' => 1000,
            'loanStatus' => 1,
            'loanId' => 10241
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/change-loan-status', $query);

        $response->assertStatus(204);
    }

    public function testApprovedAmountGreaterThanRequested()
    {
        $loanId = Loan::where('status', Loan::LOAN_STATUS_PENDING)->get()->first();

        $appHeaders['Authorization'] = 'Bearer ' . $this->managerAuthToken;
        $query = [
            'approvedAmount' => 1000000,
            'loanStatus' => 1,
            'loanId' => $loanId->id
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/change-loan-status', $query);

        $response->assertStatus(205);
    }

    public function testApproveLoan()
    {
        $loanId = Loan::where('status', Loan::LOAN_STATUS_PENDING)->get()->first();
        $manAppHeaders['Authorization'] = 'Bearer ' . $this->managerAuthToken;
        $query = [
            'approvedAmount' => 1000,
            'loanStatus' => 1,
            'loanId' => $loanId->id
        ];
        $response = $this
            ->withHeaders($manAppHeaders)
            ->json('POST', '/api/change-loan-status', $query);

        $response->assertStatus(200);
    }

    public function testRejectLoan()
    {
        $loanId = Loan::where('status', Loan::LOAN_STATUS_PENDING)->get()->first();
        $manAppHeaders['Authorization'] = 'Bearer ' . $this->managerAuthToken;
        $query = [
            'approvedAmount' => 1000,
            'loanStatus' => 2,
            'loanId' => $loanId->id
        ];
        $response = $this
            ->withHeaders($manAppHeaders)
            ->json('POST', '/api/change-loan-status', $query);

        $response->assertStatus(200);
    }

    public function testAuthTokenForRepayLoan()
    {
        $appHeaders['Authorization'] = 'Bearer ' . 'someRandomToken';
        $query = [
            'repaymentAmount' => 1000,
            'loanId' => 3
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/repay-loan', $query);
        $response->assertStatus(401);
    }

    public function testManagerAuthTokenForRepayLoan()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->managerAuthToken;
        $query = [
            'repaymentAmount' => 1000,
            'loanTerm' => 3
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/repay-loan', $query);
        $response->assertStatus(403);
    }

    public function testInvalidAmountForRepayLoan()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->userAuthToken;
        $query = [
            'repaymentAmount' => -1000,
            'loanId' => 3
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/repay-loan', $query);
        $response->assertStatus(400);
    }

    public function testInvalidLoanIdForRepayLoan()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->userAuthToken;
        $query = [
            'repaymentAmount' => 1000,
            'loanId' => 'abc'
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/repay-loan', $query);
        $response->assertStatus(400);
    }

    public function testLoanDetailsNotFoundRepayLoan()
    {
        $appHeaders['Authorization'] = 'Bearer ' . $this->userAuthToken;
        $query = [
            'repaymentAmount' => 1000,
            'loanId' => 101111
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/repay-loan', $query);
        $response->assertStatus(204);
    }

    public function testLoanNotApprovedRepayLoan()
    {
        $loanId = Loan::where('status', '<>', Loan::LOAN_STATUS_APPROVED)->get()->first();

        $appHeaders['Authorization'] = 'Bearer ' . $this->userAuthToken;
        $query = [
            'repaymentAmount' => 1000,
            'loanId' => $loanId->id
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/repay-loan', $query);
        $response->assertStatus(409);
    }

    public function testRepayAmountGreaterThanApprovedAmount()
    {
        $loanId = Loan::where('status', '=', Loan::LOAN_STATUS_APPROVED)->get()->first();

        $appHeaders['Authorization'] = 'Bearer ' . $this->userAuthToken;
        $query = [
            'repaymentAmount' => $loanId->approved_amount + 100,
            'loanId' => $loanId->id
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/repay-loan', $query);
        $response->assertStatus(409);
    }

    public function testRepayLoan()
    {
        $loanId = Loan::where('status', '=', Loan::LOAN_STATUS_APPROVED)->get()->first();

        $appHeaders['Authorization'] = 'Bearer ' . $this->userAuthToken;
        $query = [
            'repaymentAmount' => 100,
            'loanId' => $loanId->id
        ];
        $response = $this
            ->withHeaders($appHeaders)
            ->json('POST', '/api/repay-loan', $query);
        $response->assertStatus(200);
    }

}
