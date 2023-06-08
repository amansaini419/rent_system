<?php

namespace App\Http\Controllers;

use App\Models\DocumentData;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DocumentDataController extends Controller
{
	public static function upload($file, $inputName){
		$fileName = $inputName . '_' . time();
		$extension = $file->getClientOriginalExtension();
		$location = 'documents';
		$file->move($location, $fileName);
		return $location . '/' . $fileName . '.' . $extension;
	}

	public function update(Request $request)
	{
		$userData = UserData::where(DB::raw('md5(id)'), $request->userDataId)->first();
		//dd($request->all());
		if(!$userData){
			return response()->json([
				'success' => false,
				'error' => 'Invalid request.'
			], 200);
		}
		$fees = $userData->fees;
		if(!$fees){
			return response()->json([
				'success' => false,
				'error' => 'Please pay the registration fees, before uploading documents.'
			], 200);
		}
		//dd($request->file()); die();
		$validator = Validator::make($request->all(), [
			'userDataId' => 'required',
			'ghanaCard' => 'required',
			'passportPictureFile' => 'required|mimes:png,jpg,jpeg,pdf',
			'ghanaCardFile' => 'required|mimes:png,jpg,jpeg,pdf',
			'bankStatementFile' => 'required|mimes:png,jpg,jpeg,pdf',
			'employmentLetterFile' => 'required|mimes:png,jpg,jpeg,pdf',
		]);
		if ($validator->fails()) {
			return response()->json([
				'success' => false,
				'errors' => $validator->messages()
			], 200);
		}
		//DB::enableQueryLog();
		/* $passportPicturePath = $request->file('passportPictureFile')->store('documents');
		$ghanaCardPath = $request->file('ghanaCardFile')->store('documents');
		$bankStatementFilePath = $request->file('bankStatementFile')->store('documents');
		$employmentLetterPath = $request->file('employmentLetterFile')->store('documents'); */
		$passportPicturePath = DocumentDataController::upload($request->file('passportPictureFile'), 'passportPictureFile');
		$ghanaCardPath = DocumentDataController::upload($request->file('ghanaCardFile'), 'ghanaCardFile');
		$bankStatementFilePath = DocumentDataController::upload($request->file('bankStatementFile'), 'bankStatementFile');
		$employmentLetterPath = DocumentDataController::upload($request->file('employmentLetterFile'), 'employmentLetterFile');
		$updated = DocumentData::where(DB::raw('md5(user_data_id)'), $request->userDataId)
			->update([
				'passport_picture_path' => $passportPicturePath,
				'ghana_card' => $request->ghanaCard,
				'ghana_card_path' => $ghanaCardPath,
				'statement_path' => $bankStatementFilePath,
				'employment_letter_path' => $employmentLetterPath,
				'is_filled' => 1,
			]);

		//dd(DB::getQueryLog());
		if ($updated === 0) {
			return response()->json([
				'success' => false,
				'error' => 'Unable to update the document data.'
			], 200);
		}
		return response()->json([
			'success' => true,
			'message' => 'Successfully updated the document data.'
		], 200);
	}
}
