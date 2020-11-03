<?php

  function assistant() {
    return auth()->guard('assistant')->user();
  }

  function md1() {
    return auth()->guard('md1')->user();
  }

  function md2() {
    return auth()->guard('md2')->user();
  }

  function jsonformat($status, $message, $data) {
    return response()->json([
      'status'  => $status,
      'message' => $message,
      'data'    => $data
    ]);
  }

