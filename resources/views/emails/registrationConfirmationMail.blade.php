@extends('layouts.email')

@section('title')
  REGISTRATION CONFIRMATION
@endsection

@section('body')
  <tr>
    <td align="center" bgcolor="#ffffff"
      style="padding: 40px 20px 40px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px; border-bottom: 1px solid #f6f6f6;">
      <h1>{{ $mailData['title'] }}</h1>
      <br />
      <p>{{ $mailData['body'] }}</p>
    </td>
  </tr>
@endsection
