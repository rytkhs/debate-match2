<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the application for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    // General UI elements
    'login' => 'Login',
    'register' => 'Register',
    'logout' => 'Logout',
    'my_profile' => 'My Profile',
    'search_room' => 'Search Room',
    'create_room' => 'Create Room',
    'how_to_use' => 'How to Use',
    'terms_of_service' => 'Terms',
    'privacy_policy' => 'Privacy',
    'contact_us' => 'Contact Us',
    'submit' => 'Submit',
    'confirm' => 'Confirm',
    'cancel' => 'Cancel',
    'delete' => 'Delete',
    'edit' => 'Edit',
    'save' => 'Save',
    'name' => 'Name',
    'email' => 'Email',
    'password' => 'Password',
    'confirm_password' => 'Confirm Password',
    'forgot_password' => 'Forgot your password?',
    'remember_me' => 'Remember me',
    'status' => 'Status',
    'action' => 'Action',
    'optional' => 'Optional',
    'close' => 'Close',
    'back' => 'Back',
    'notes' => 'Notes',
    // Navigation
    'home' => 'Home',
    'debate_rooms' => 'Debate Rooms',
    'debate_history' => 'Debate History',
    'language_en_label' => 'English',
    'language_ja_label' => '日本語',
    'current_language_indicator' => '(Current)',

    // Room related (Common)
    'room_name' => 'Room Name',
    'topic' => 'Topic',
    'language' => 'Language Setting',
    'language_used' => 'Language Used',
    'debate_format' => 'Debate Format',
    'format_details' => 'Format Details',
    'format_name' => 'Format Name',
    'total_time' => 'Total Time',
    'remarks' => 'Remarks',
    'host' => 'Host',
    'participants' => 'Participants',
    'affirmative_side' => 'Affirmative Side',
    'negative_side' => 'Negative Side',
    'affirmative' => 'Affirmative',
    'negative' => 'Negative',
    'side' => 'Side',

    // Room Creation (create.blade.php)
    'create_new_room' => 'Create New Room',
    'basic_information' => 'Basic Information',
    'placeholder_topic' => 'Enter topic here',
    'topic_guideline' => 'Enter a clear proposition for the debate topic.',
    'placeholder_room_name' => 'Enter room name here',
    'placeholder_remarks' => 'Enter any special rules or notes',
    'debate_settings' => 'Debate Settings',
    'your_side' => 'Your Side',
    'agree_with_topic' => 'Agree with the topic',
    'disagree_with_topic' => 'Disagree with the topic',
    'format' => 'Format',
    'format_suffix' => ' Format',
    'select_format' => 'Select Format',
    'custom_format' => 'Custom Format',
    'format_selection_guide' => 'Select the format for the debate. Choose "Custom Format" to configure it freely.',
    'format_preview' => 'Format Preview',
    'configure_custom_format' => 'Configure Custom Format',
    'custom_format_guide' => 'Set the "Side", "Speech Name", and "Duration" for each part. You can include "Prep Time" or "Cross Examination". At least one part is required.',
    'parts' => 'Parts',
    'part' => 'Part',
    'add_part' => 'Add Part',
    'remove_part' => 'Remove Part',
    'part_name' => 'Speech Name',
    'placeholder_part_name' => 'e.g., 1st Constructive, 2nd Rebuttal',
    'speaker' => 'Speaker',
    'time_minutes' => 'Time (minutes)',
    'save_format' => 'Save Format',
    'standard_format' => 'Standard Format',
    'custom' => 'Custom',
    'japanese' => 'Japanese',
    'english' => 'English',
    'minute_unit' => 'min',
    'duration_minutes' => 'Duration (min)',
    'question_time' => 'CX',
    'prep_time' => 'Prep Time',

    // Datalist suggestions
    'suggestion_constructive' => 'Constructive Speech',
    'suggestion_first_constructive' => 'First Constructive',
    'suggestion_second_constructive' => 'Second Constructive',
    'suggestion_rebuttal' => 'Rebuttal Speech',
    'suggestion_first_rebuttal' => 'First Rebuttal',
    'suggestion_second_rebuttal' => 'Second Rebuttal',
    'suggestion_questioning' => 'Cross Examination',
    'suggestion_prep_time' => 'Prep Time',

    // Room Index (index.blade.php)
    'confirm_delete_room' => 'Are you sure you want to delete this room?',
    'deleting_room' => 'Deleting room...',
    'failed_to_delete_room' => 'Failed to delete room.',
    'room_list' => 'Room List',
    'no_rooms_available' => 'No rooms available.',
    'created_at' => 'Created At',
    'view_details' => 'View Details',
    'lets_create_room' => "Let's create a new debate room",
    'language_ja' => 'Japanese',
    'language_en' => 'English',

    // Room Show / Preview (show.blade.php / preview.blade.php)
    'back_to_room_list' => 'Back to Room List',
    'room_details' => 'Room Details',
    'room_status' => 'Room Status',
    'created_by' => 'Created By',
    'waiting' => 'Waiting',
    'ready' => 'Ready',
    'debating' => 'Debating',
    'evaluating' => 'Evaluating',
    'finished' => 'Finished',
    'terminated' => 'Terminated',
    'join_affirmative' => 'Join as Affirmative',
    'join_negative' => 'Join as Negative',
    'join_as_affirmative' => 'Join as Affirmative',
    'join_as_negative' => 'Join as Negative',
    'leave_room' => 'Leave Room',
    'confirm_leave_room' => 'Are you sure you want to leave this room?',
    'leaving_room' => 'Leaving room...',
    'failed_to_leave_room' => 'Failed to leave room.',
    'confirm_start_debate' => 'Are you sure you want to start the debate?',
    'starting_debate' => 'Starting debate...',
    'failed_to_start_debate' => 'Failed to start debate.',
    'not_participating' => 'Not Participating',
    'join_debate' => 'Join Debate',
    'select_side_to_join' => 'Select the side you want to join.',
    'room_is_full' => 'This room is already full.',
    'cannot_join_room' => 'You cannot join this room now.',
    'confirm_join_room_side' => 'Are you sure you want to join the room on the selected side?',
    'debate_room' => 'Debate Room',
    'exit_room' => 'Exit Room',
    'starting_debate_title' => 'Starting Debate',
    'redirecting_to_debate_soon' => 'Redirecting to the debate page soon...',
    'confirm_exit_creator' => 'If the host leaves, the room will be closed. Are you sure you want to leave?',
    'confirm_exit_participant' => 'Are you sure you want to leave the room?',


    // Livewire Components
    'network_disconnected' => 'Network connection lost.',
    'reconnecting_in_seconds' => 'Trying to reconnect in :seconds seconds...',
    'connection_restored' => 'Connection restored.',
    'recruiting' => 'Recruiting...',
    'waiting_for_participants' => 'Waiting for participants...',
    'debaters_ready' => 'Debaters ready!',
    'please_start_debate' => 'Please start the debate.',
    'wait_for_debate_start' => 'Waiting for the host to start the debate...',
    'auto_redirect_on_start' => 'You will be redirected automatically.',
    'debate_in_progress_message' => 'Debate is in progress.',
    'click_if_no_redirect' => 'Click here if you are not redirected.',
    'start_debate' => 'Start Debate',
    'waiting_status' => 'Waiting',
    'ready_status' => 'Ready',
    'closed_status' => 'Closed',
    'unknown_status' => 'Unknown',
    'peer_connection_unstable' => 'Opponent connection unstable.',
    'waiting_for_reconnection' => 'Waiting for reconnection...',

    // Error Pages
    'go_back_page' => 'Go Back',
    'back_to_home' => 'Back to Home',
    'find_debate_room' => 'Find Debate Room',
    'refresh_page' => 'Refresh Page',
    'update' => 'Update',
    'error_401_title' => 'Unauthorized (401)',
    'error_401_message' => 'Authentication is required to access this page.',
    'error_401_action' => 'Please log in and try again.',
    'error_403_title' => 'Forbidden (403)',
    'error_403_message' => 'You do not have permission to access this resource.',
    'error_403_action' => 'Please log in with a different account or return to the homepage.',
    'error_404_title' => 'Page Not Found (404)',
    'error_404_message' => 'The page you are looking for does not exist or may have been moved.',
    'error_404_action' => 'Please check the URL or return to the homepage using the links below.',
    'error_419_title' => 'Page Expired (419)',
    'error_419_message' => 'Your session has expired, and the operation could not be completed.',
    'error_419_action' => 'Please refresh the page and try again.',
    'error_429_title' => 'Too Many Requests (429)',
    'error_429_message' => 'Too many requests have been made in a short period of time.',
    'error_429_action' => 'Please wait a moment and try again.',
    'error_500_title' => 'Server Error (500)',
    'error_500_message' => 'An internal server error occurred.',
    'error_500_action' => 'If the problem persists, please contact the administrator.',
    'error_503_title' => 'Service Unavailable (503)',
    'error_503_message' => 'The service is currently under maintenance.',
    'error_503_action' => 'Please try accessing again later.',

    // JavaScript Translations (for window.translations)
    'debate_finished_title' => 'Debate Finished',
    'evaluating_message' => 'Evaluating with AI. Please wait a moment...',
    'evaluation_complete_title' => 'Debate Evaluation Complete',
    'redirecting_to_results' => 'Redirecting to the results page.',
    'host_left_terminated' => 'The debate has been terminated because the opponent disconnected.',
    'debate_finished_overlay_title' => 'Debate Finished',
    'evaluating_overlay_message' => 'The debate has finished. AI evaluation is currently in progress...',
    'go_to_results_page' => 'Go to Results Page',
    'user_joined_room' => ':name has joined.',
    'user_left_room' => ':name has left.',
    'host_left_room_closed' => 'The room has been closed because the host left.',
    'debate_starting_message' => 'Starting the debate. Preparing to navigate...',
    'redirecting_in_seconds' => 'Redirecting to the debate page in :seconds seconds...',
    'format_info_missing' => 'Format information not found.',
    'minute_suffix' => ' min',

    // Dashboard
    'dashboard' => 'Dashboard',
    'logged_in' => "You're logged in!",

    // Authentication
    'confirm_password_message' => 'This is a secure area of the application. Please confirm your password before continuing.',
    'forgot_password_message' => 'Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.',
    'reset_password' => 'Reset Password',
    'verify_email_message' => 'Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.',
    'verification_link_sent' => 'A new verification link has been sent to the email address you provided during registration.',
    'resend_verification_email' => 'Resend Verification Email',
    'or' => 'Or',
    'login_with_google' => 'Login with Google',
    'login_with_x' => 'Login with X',
    'agree_terms_privacy' => 'By proceeding, you agree to our terms and privacy.',
    'create_account' => 'Create Account',

    // Footer
    'copyright' => '© :year DebateMatch. All rights reserved.',
    'support' => 'Support',

    // Debate Chat & Interface
    'all' => 'All',
    'affirmative_side_label' => 'Affirmative',
    'negative_side_label' => 'Negative',
    'no_messages_yet' => 'No messages yet.',
    'new_message' => 'New Message',
    'your_turn' => 'Your Turn',
    'prep_time_turn' => 'Prep Time',
    'opponent_turn' => "Opponent's Turn",
    'remaining_time' => 'Remaining',
    'prep_time_in_progress' => 'Prep time in progress...',
    'ready_to_send' => 'Ready to send',
    'questioning_in_progress' => 'Cross Examination in progress...',
    'enter_message_placeholder' => 'Enter your message...',
    'send' => 'Send',
    'debaters' => 'Debaters',
    'speaking' => 'Speaking',
    'online' => 'Online',
    'offline' => 'Offline',
    'confirm_end_turn' => 'End the :currentTurnName turn and proceed to :nextTurnName?',
    'processing' => 'Processing...',
    'end_turn' => 'End Speech',
    'current_turn_info' => 'Current Turn Info',
    'remaining_time_label' => 'Remaining:',
    'progress' => 'Progress',
    'questions_allowed' => 'CX Allowed',
    'completed' => 'Completed',

    // Records
    'room_label' => 'Room:',
    'host_label' => 'Host:',
    'winner_label' => 'WINNER',
    'result_tab' => 'Result',
    'debate_content_tab' => 'Debate Content',
    'analysis_of_points' => 'Analysis of Points',
    'judgment_result' => 'Judgment Result',
    'winner_is' => 'Winner:',
    'feedback' => 'Feedback',
    'feedback_for_affirmative' => 'Feedback for Affirmative',
    'feedback_for_negative' => 'Feedback for Negative',
    'no_evaluation_available' => 'No evaluation data available for this debate.',
    'view_debate_history' => 'View Debate History',

    // Welcome Page
    'start_online_debate' => 'Start Your Online Debate Now',
    'welcome_description' => 'DebateMatch is a platform where you can engage in online debates, improve your discussion skills, logical thinking, and expressive power.',
    'features_title' => 'Features',
    'realtime_chat' => 'Real-time Chat',
    'realtime_chat_description' => 'Engage in text-based debates that proceed in real-time.',
    'time_management' => 'Time Management',
    'time_management_description' => 'Each part has a time limit managed by a countdown timer.',
    'ai_feedback' => 'AI Feedback',
    'ai_feedback_description' => 'After the debate, AI analyzes the discussion and provides feedback.',
    'step1_title' => '1. Create/Join Room',
    'step1_description' => 'Create your own debate room or join an existing one.',
    'step2_title' => '2. Wait for Opponent',
    'step2_description' => 'Wait for an opponent to join, or the host to start.',
    'step3_title' => '3. Start Debating',
    'step3_description' => 'Debate according to the format rules and time limits.',
    'faq_title' => 'Frequently Asked Questions',
    'faq1_question' => 'Is it beginner-friendly?',
    'faq1_answer' => 'Yes! We provide a guide page to help you get started.',
    'usage_guide' => 'Usage Guide',
    'faq2_question' => 'Is there a fee?',
    'faq2_answer' => 'Currently, all features are available for free.',
    'faq3_question' => 'What do I need to start?',
    'faq3_answer' => 'A web browser and an internet connection are all you need. No special software installation is required.',
    'faq4_question' => 'Can I use it on a smartphone?',
    'faq4_answer' => 'Yes, it is designed to be responsive and usable on smartphones and tablets. However, since debates display a lot of information, we recommend using a computer or tablet with a larger screen for a more comfortable experience.',
    'faq5_question' => 'How accurate is the AI feedback?',
    'faq5_answer' => 'The AI provides analysis based on general argumentation principles but may not cover all nuances. Use it as one reference for improvement.',

    // Guide Page
    'guide_title' => 'How to Use DebateMatch',
    'guide_description' => 'Learn how to use DebateMatch, from creating a room to receiving AI feedback.',
    'main_features' => 'Main Features',
    'room_management' => 'Room Management',
    'room_management_description' => 'Create and manage debate rooms, or join existing ones.',
    'realtime_chat_feature_description' => 'Debate progresses through real-time text chat. Messages are sent and received instantly.',
    'auto_progress_timer' => 'Automatic Progression & Timer',
    'auto_progress_timer_description' => 'Follows debate format rules, with automatic turn transitions based on the timer.',
    'ai_critique' => 'AI Critique',
    'ai_critique_description' => 'After the debate, AI analyzes arguments, determines the winner, and provides feedback.',
    'debate_flow' => 'Debate Flow',
    'step1_preparation' => 'Step 1: Preparation',
    'prep_step1_title' => '1. User Registration/Login',
    'prep_step1_desc1' => 'First, please <a href=":register_url" class="text-primary underline">register</a> or <a href=":login_url" class="text-primary underline">log in</a>.',
    'prep_step1_desc2' => 'You can also log in using Google.',
    'prep_step2_title' => '2. Find or Create a Room',
    'prep_step2_desc1' => 'Find a room you want to join from the <a href=":index_url" class="text-primary underline">Room List</a> or <a href=":create_url" class="text-primary underline">create a new room</a>.',
    'prep_step2_desc2' => 'When creating, set the topic, language, and debate format.',
    'step2_matching' => 'Step 2: Matching',
    'match_step1_title' => '1. Join the Room',
    'match_step1_desc1' => 'If you created a room, wait for an opponent. If you joined, wait for the host.',
    'match_step1_desc2' => 'Select either the affirmative or negative side to participate.',
    'match_step2_title' => '2. Wait and Start',
    'match_step2_desc1' => 'Once both sides have participants, the room status becomes "Ready".',
    'match_step2_desc2' => 'The room creator (host) can then start the debate by clicking the "Start Debate" button.',
    'step3_debate' => 'Step 3: Debate',
    'debate_step1_title' => 'Debate Screen Overview',
    'debate_timeline' => 'Timeline',
    'debate_timeline_desc' => 'Shows the overall flow and current progress of the debate.',
    'debate_chat_area' => 'Chat Area',
    'debate_chat_area_desc' => 'Displays the messages exchanged during the debate.',
    'debate_message_input' => 'Message Input Area',
    'debate_message_input_desc' => 'Enter and send your arguments here during your turn.',
    'debate_participant_list' => 'Participant List',
    'debate_participant_list_desc' => 'Shows the participants for each side and their online status.',
    'debate_timer' => 'Timer',
    'debate_timer_desc' => 'Displays the remaining time for the current turn. Turns advance automatically when time runs out.',
    'debate_prep_time' => 'Preparation Time',
    'debate_prep_time_desc' => 'Some formats include preparation time. During this time, you cannot send messages.',
    'debate_qa_time' => 'Cross Examination Time',
    'debate_qa_time_desc' => 'During Cross Examination, both sides can send messages.',
    'debate_leave_interrupt' => 'Leaving/Interruption',
    'debate_leave_interrupt_desc' => 'If one participant disconnects or leaves, the debate will be terminated.',
    'step4_critique_history' => 'Step 4: Critique & History',
    'critique_step1_title' => '1. Debate End & AI Critique',
    'critique_step1_desc1' => 'Once the debate concludes, AI evaluation begins automatically.',
    'critique_step1_desc2' => 'You will be automatically redirected to the results page upon completion.',
    'critique_step2_title' => '2. Check the Results',
    'critique_step2_desc1' => 'The results page displays the AI\'s critique, including:',
    'critique_result_win_loss' => 'Win/Loss Judgment',
    'critique_result_point_analysis' => 'Analysis of Key Points',
    'critique_result_reason' => 'Reason for Judgment',
    'critique_result_feedback' => 'Feedback for Each Side',
    'critique_step2_desc2' => 'Use this feedback to reflect on your debate and identify areas for improvement.',
    'critique_step3_title' => '3. Check Debate History',
    'critique_step3_desc1' => 'You can check your past debate history <a href=":url" class="text-primary underline">here</a>.',
    'critique_step3_desc2' => 'Review past debates and feedback to track your progress.',
    'debate_formats' => 'Debate Formats',
    'debate_formats_description' => 'DebateMatch supports several standard debate formats. You can also create custom formats.',
    'available_formats' => 'Available Standard Formats:',
    'custom_format_description' => 'When creating a room, you can choose the "Custom" format and set up the parts freely by defining the name, speaker, and duration for each part.',
    'faq_guide1_q' => 'Is there anything I should be careful about during the debate?',
    'faq_guide1_a' => 'Please adhere to the time limits for each turn. Also, maintain respectful communication with your opponent.',
    'faq_guide2_q' => 'Can I review the debate content after it ends?',
    'faq_guide2_a' => 'Yes, you can review the detailed content and AI critique from the Debate History page.',
    'faq_guide3_q' => 'What happens if the connection is lost during the debate?',
    'faq_guide3_a' => 'If the connection is lost and cannot be restored within a certain period, the debate may be terminated.',
    'faq_guide4_q' => 'Can I create my own debate format?',
    'faq_guide4_a' => 'Yes, when creating a room, you can choose the "Custom" format and set up the parts freely.',
    'faq_guide5_q' => 'How is the winner determined by the AI?',
    'faq_guide5_a' => 'The AI evaluates the relevance, logical consistency, evidence, and persuasiveness of the arguments presented by both sides.',
    'when_in_trouble' => 'When in Trouble',
    'trouble_description' => 'If you encounter any problems or have questions, please check the Terms of Service and Privacy Policy, or contact us through the inquiry form.',

    // Profile Edit
    'profile_information' => 'Profile Information',
    'update_profile_description' => 'Update your account\'s profile information and email address.',
    'saved' => 'Saved.',
    'update_password' => 'Update Password',
    'update_password_description' => 'Ensure your account is using a long, random password to stay secure.',
    'current_password' => 'Current Password',
    'new_password' => 'New Password',
    'confirm_new_password' => 'Confirm New Password',
    'delete_account' => 'Delete Account',
    'delete_account_warning' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.',
    'confirm_delete_account' => 'Are you sure you want to delete your account?',
    'confirm_delete_account_message' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.',

    // Validation etc.
    'validation.required' => 'The :attribute field is required.',
    'validation.string' => 'The :attribute must be a string.',
    'validation.max.string' => 'The :attribute may not be greater than :max characters.',


    'already_have_account' => 'Already have an account?',
    'create' => 'Create',

    'google_login' => 'Login with Google',
    'twitter_login' => 'Login with Twitter',

    'debate_information_tab' => 'Debate Information',
    'timeline_tab' => 'Timeline',


    'your_stats' => 'Your Statistics',
    'total_debates' => 'Total Debates',
    'wins_count' => 'Wins',
    'losses_count' => 'Losses',
    'win_rate' => 'Win Rate',
    'all_sides' => 'All Sides',
    'all_results' => 'All Results',
    'win' => 'Win',
    'loss' => 'Loss',
    'newest_first' => 'Newest First',
    'oldest_first' => 'Oldest First',
    'search_topic_placeholder' => 'Search topic',
    'reset_filters' => 'Reset',
    'apply_filters' => 'Apply',
    'records_count' => 'Showing: :first-:last / Total:total',
    'filter_applied_indicator' => '(Filter Applied)',
    'view_format_label' => 'View Format:',
    'opponent' => 'Opponent',
    'evaluation_label' => 'Evaluation',
    'no_debate_records' => 'No debate records',

    'connection_lost_title' => 'Connection Lost',
    'connection_lost_message' => 'Connection to the server was lost. Attempting to reconnect...',
    'reconnecting_message' => 'Reconnecting...',
    'reconnecting_failed_message' => 'Reconnection failed. Please reload the page.',
    'redirecting_after_termination' => 'Redirecting to the top page in 5 seconds...',

    'evidence_usage' => 'Evidence Usage',
    'evidence_allowed' => 'Evidence Allowed',
    'evidence_not_allowed' => 'No Evidence',
    'can_use_evidence' => 'Can use external sources',
    'cannot_use_evidence' => 'Only personal knowledge',

    'google_login_failed' => 'Google login failed. Please try again.',

    'start_ai_debate' => 'Start AI Debate',
    'ai_debate_button' => 'AI Debate',
    'ai_user_not_found' => 'AI user not found. Please contact the system administrator.',
    'ai_debate_started' => 'AI debate started successfully!',
    'ai_debate_creation_failed' => 'Failed to create AI debate. Please try again.',

    'ai_label' => 'AI',
    'ai_thinking' => 'AI is generating response...',
    // 'ai_turn' => 'AI Turn',
    'cannot_send_message_now' => 'Cannot send message now',

    'confirm_exit_ai_debate' => 'Are you sure you want to exit this AI debate? The debate will be terminated.',
    'exit_debate' => 'Exit',
    'ai_turn' => 'AI is speaking',

    'ai_evidence_not_supported' => 'Currently, evidence are not supported in this mode.',
];
