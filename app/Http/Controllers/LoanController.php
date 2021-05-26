<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\LoanRepayment;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoanController extends Controller
{
    public function requestLoan(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $response = [];
        $response['status'] = false;

        if (!$user) {
            $response['message'] = 'Unauthenticated access';
            return response()->json($response)->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }
        if ($user->role != User::ROLE_LOAN_USER) {
            $response['message'] = 'Unauthorised access';
            return response()->json($response)->setStatusCode(Response::HTTP_FORBIDDEN);
        }

        $loanAmount = $request->get('loanAmount');
        $loanTerm = $request->get('loanTerm');
        $loanRemarks = $request->get('loanRemarks');

        if (!$this->isValidInteger($loanAmount)) {
            $response['message'] = 'Please provide valid loan amount';
            return response()->json($response)->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        if (!$this->isValidInteger($loanTerm)) {
            $response['message'] = 'Please provide valid loan term';
            return response()->json($response)->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        $loanDetails = [];
        $date = Carbon::now();
        $loanDetails['user_id'] = $user->id;
        $loanDetails['request_amount'] = $loanAmount;
        $loanDetails['request_date'] = $date;
        $loanDetails['term'] = $loanTerm;
        $loanDetails['user_remarks'] = $loanRemarks;
        $loanDetails['status'] = Loan::LOAN_STATUS_PENDING;

        $loanId = Loan::create($loanDetails);

        if ($loanId) {
            $response['status'] = true;
            $response['message'] = 'Loan requested successfully raised';
            $response['loan_details'] = $loanId;
            return response()->json($response)->setStatusCode(Response::HTTP_OK);
        } else {
            $response['message'] = 'Unable to process loan';
            return response()->json($response)->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getLoanListByUser()
    {
        $user = Auth::user();

        $response = [];
        $response['status'] = false;
        if (!$user) {
            $response['message'] = 'Unauthenticated access';
            return response()->json($response)->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }
        if ($user->role != User::ROLE_LOAN_USER) {
            $response['message'] = 'Unauthorised access';
            return response()->json($response)->setStatusCode(Response::HTTP_FORBIDDEN);
        }

        $loans = Loan::where('user_id', $user->id)->with('loanRepayment')->get()->toArray();

        $response['status'] = true;
        if (count($loans)) {
            $response['message'] = 'Loan List';
            $response['data'] = $loans;
        } else {
            $response['message'] = 'No Loans';
            $response['data'] = [];
        }

        return response()->json($response)->setStatusCode(Response::HTTP_OK);
    }

    public function changeLoanStatus(Request $request)
    {
        $user = Auth::user();
        $response = [];
        $response['status'] = false;

        if (!$user) {
            $response['message'] = 'Unauthenticated access';
            return response()->json($response)->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }
        if ($user->role != User::ROLE_LOAN_MANAGER) {
            $response['message'] = 'Unauthorised access';
            return response()->json($response)->setStatusCode(Response::HTTP_FORBIDDEN);
        }

        $approvedAmount = $request->get('approvedAmount');
        $loanId = $request->get('loanId');
        $loanStatus = $request->get('loanStatus');
        $remarks = $request->get('remarks');

        if (!$this->isValidInteger($approvedAmount)) {
            $response['message'] = 'Please provide valid approved amount';
            return response()->json($response)->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        if (!$this->isValidInteger($loanId)) {
            $response['message'] = 'Please provide valid loan id';
            return response()->json($response)->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        if (!in_array($loanStatus, [Loan::LOAN_STATUS_APPROVED, Loan::LOAN_STATUS_REJECTED])) {
            $response['message'] = 'Please provide valid loan status';
            return response()->json($response)->setStatusCode(Response::HTTP_BAD_REQUEST);
        }


        $loanDetails = Loan::where('id', $loanId)->get()->first();

        if (empty($loanDetails)) {
            $response['message'] = 'Loan details not found';
            return response()->json($response)->setStatusCode(204);
        }

        if ($loanDetails->status != Loan::LOAN_STATUS_PENDING) {
            $response['message'] = 'Loan already processed';
            return response()->json($response)->setStatusCode(Response::HTTP_CONFLICT);
        }

        $message = 'Loan approved';
        if ($loanStatus == Loan::LOAN_STATUS_REJECTED) {
            $approvedAmount = 0;
            $message = 'Loan rejected';
        }
        if (intval($approvedAmount) > intval($loanDetails->request_amount)) {
            $response['message'] = 'Approved amount is more than requested amount.';
            return response()->json($response)->setStatusCode(205);
        }
        $loanDetails->approved_amount = $approvedAmount;
        $loanDetails->status = $loanStatus;
        $loanDetails->manager_remarks = $remarks;
        $loanDetails->approved_by = $user->id;
        $loanDetails->approved_date = Carbon::now();
        $loanDetails->save();

        $response['status'] = true;
        $response['message'] = $message;
        $response['loan_details'] = $loanDetails;
        return response()->json($response)->setStatusCode(Response::HTTP_OK);
    }

    public function repayLoan(Request $request)
    {
        $user = Auth::user();
        $response = [];
        $response['status'] = false;
        if (!$user) {
            $response['message'] = 'Unauthenticated access';
            return response()->json($response)->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }
        if ($user->role != User::ROLE_LOAN_USER) {
            $response['message'] = 'Unauthorised access';
            return response()->json($response)->setStatusCode(Response::HTTP_FORBIDDEN);
        }

        $repaymentAmount = $request->get('repaymentAmount');
        $loanId = $request->get('loanId');

        if (!$this->isValidInteger($loanId)) {
            $response['message'] = 'Please provide valid loan id';
            return response()->json($response)->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        if (!$this->isValidInteger($repaymentAmount)) {
            $response['message'] = 'Please provide valid amount';
            return response()->json($response)->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        $loanDetails = Loan::where('id', $loanId)->get()->first();

        if (empty($loanDetails)) {
            $response['message'] = 'Loan details not found';
            return response()->json($response)->setStatusCode(204);
        }

        if ($loanDetails->status != Loan::LOAN_STATUS_APPROVED) {
            $response['message'] = 'You can only repay approved loans';
            return response()->json($response)->setStatusCode(Response::HTTP_CONFLICT);
        }

        $alreadyPaidAmount = LoanRepayment::where('loan_id', $loanId)->get()->sum('amount');

        if (($alreadyPaidAmount + intval($repaymentAmount)) > $loanDetails->approved_amount) {
            $response['message'] = 'Repayment amount is greater than approved amount';
            return response()->json($response)->setStatusCode(Response::HTTP_CONFLICT);
        }

        $loanRepaymentDetails = [];

        $loanRepaymentDetails['loan_id'] = $loanId;
        $loanRepaymentDetails['amount'] = $repaymentAmount;
        $loanRepaymentDetails['paid_date'] = Carbon::now();


        $loanRepaymentId = LoanRepayment::create($loanRepaymentDetails);
        if ($loanRepaymentId) {
            if ($alreadyPaidAmount + intval($repaymentAmount) == $loanDetails->approved_amount) {
                $loanDetails->status = Loan::LOAN_STATUS_CLEARED;
            }
            $loanDetails->save();
            $response['status'] = true;
            $response['message'] = 'Loan amount paid';
            $response['loan_repayment_details'] = $loanRepaymentId;
            return response()->json($response)->setStatusCode(Response::HTTP_OK);
        } else {
            $response['message'] = 'Unable to pay loan';
            return response()->json($response)->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
