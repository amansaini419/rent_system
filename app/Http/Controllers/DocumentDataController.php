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
		$extension = $file->getClientOriginalExtension();
		$fileName = $inputName . '_' . time() . '.' . $extension;
		$location = 'documents';
		$file->move($location, $fileName);
		return $location . '/' . $fileName;
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
		$documentData = $userData->documentData;
		if($documentData && $documentData->passport_picture_path == null && $documentData->ghana_card_path == null && $documentData->statement_path == null && $documentData->employment_letter_path == null){
			$imgReq = 'required|mimes:png,jpg,jpeg,pdf';
			$validator = Validator::make($request->all(), [
				'userDataId' => 'required',
				'ghanaCard' => 'required',
				'passportPictureFile' => $imgReq,
				'ghanaCardFile' => $imgReq,
				'bankStatementFile' => $imgReq,
				'employmentLetterFile' => $imgReq,
			]);
			if ($validator->fails()) {
				return response()->json([
					'success' => false,
					'errors' => $validator->messages()
				], 200);
			}
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
		}
		else{
			$validator = Validator::make($request->all(), [
				'userDataId' => 'required',
				'ghanaCard' => 'required',
			]);
			if ($validator->fails()) {
				return response()->json([
					'success' => false,
					'errors' => $validator->messages()
				], 200);
			}
			$updated = DocumentData::where(DB::raw('md5(user_data_id)'), $request->userDataId)
				->update([
					'ghana_card' => $request->ghanaCard,
					'is_filled' => 1,
				]);
		}

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
