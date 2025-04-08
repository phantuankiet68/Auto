<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
class CheckIssuePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $setting = Setting::where('user_id', Auth::user()->id)->first();
            if ($setting && $setting->setting == 1) {
                view()->share('can_view_setting', true);
            } else {
                view()->share('can_view_setting', false);
            }
            if ($setting && $setting->issue == 1) {
                view()->share('can_view_issue', true);
            } else {
                view()->share('can_view_issue', false);
            }
            if ($setting && $setting->posts == 1) {
                view()->share('can_view_posts', true);
            } else {
                view()->share('can_view_posts', false);
            }
            if ($setting && $setting->chat == 1) {
                view()->share('can_view_chat', true);
            } else {
                view()->share('can_view_chat', false);
            }
            if ($setting && $setting->task == 1) {
                view()->share('can_view_task', true);
            } else {
                view()->share('can_view_task', false);
            }
            if ($setting && $setting->workflow == 1) {
                view()->share('can_view_workflow', true);
            } else {
                view()->share('can_view_workflow', false);
            }
            if ($setting && $setting->salary == 1) {
                view()->share('can_view_salary', true);
            } else {
                view()->share('can_view_salary', false);
            }
            if ($setting && $setting->expense == 1) {
                view()->share('can_view_expense', true);
            } else {
                view()->share('can_view_expense', false);
            }
            if ($setting && $setting->add_japanese == 1) {
                view()->share('can_view_add_japanese', true);
            } else {
                view()->share('can_view_add_japanese', false);
            }
            if ($setting && $setting->japanese == 1) {
                view()->share('can_view_japanese', true);
            } else {
                view()->share('can_view_japanese', false);
            }
            if ($setting && $setting->learn_japanese == 1) {
                view()->share('can_view_learn_japanese', true);
            } else {
                view()->share('can_view_learn_japanese', false);
            }
            if ($setting && $setting->add_english == 1) {
                view()->share('can_view_add_english', true);
            } else {
                view()->share('can_view_add_english', false);
            }
            if ($setting && $setting->english == 1) {
                view()->share('can_view_english', true);
            } else {
                view()->share('can_view_english', false);
            }
            if ($setting && $setting->learn_english == 1) {
                view()->share('can_view_learn_english', true);
            } else {
                view()->share('can_view_learn_english', false);
            }
            if ($setting && $setting->question == 1) {
                view()->share('can_view_question', true);
            } else {
                view()->share('can_view_question', false);
            }
            if ($setting && $setting->word == 1) {
                view()->share('can_view_word', true);
            } else {
                view()->share('can_view_word', false);
            }
            if ($setting && $setting->excel == 1) {
                view()->share('can_view_excel', true);
            } else {
                view()->share('can_view_excel', false);
            }
            if ($setting && $setting->test_code == 1) {
                view()->share('can_view_test_code', true);
            } else {
                view()->share('can_view_test_code', false);
            }
            if ($setting && $setting->component == 1) {
                view()->share('can_view_component', true);
            } else {
                view()->share('can_view_component', false);
            }
            if ($setting && $setting->color == 1) {
                view()->share('can_view_color', true);
            } else {
                view()->share('can_view_color', false);
            }
            if ($setting && $setting->html == 1) {
                view()->share('can_view_html', true);
            } else {
                view()->share('can_view_html', false);
            }
            if ($setting && $setting->js == 1) {
                view()->share('can_view_js', true);
            } else {
                view()->share('can_view_js', false);
            }
            if ($setting && $setting->vue == 1) {
                view()->share('can_view_vue', true);
            } else {
                view()->share('can_view_vue', false);
            }
            if ($setting && $setting->react == 1) {
                view()->share('can_view_react', true);
            } else {
                view()->share('can_view_react', false);
            }
            if ($setting && $setting->jquery == 1) {
                view()->share('can_view_jquery', true);
            } else {
                view()->share('can_view_jquery', false);
            }
            if ($setting && $setting->angular == 1) {
                view()->share('can_view_angular', true);
            } else {
                view()->share('can_view_angular', false);
            }
            if ($setting && $setting->php == 1) {
                view()->share('can_view_php', true);
            } else {
                view()->share('can_view_php', false);
            }
            if ($setting && $setting->laravel == 1) {
                view()->share('can_view_laravel', true);
            } else {
                view()->share('can_view_laravel', false);
            }
            if ($setting && $setting->node == 1) {
                view()->share('can_view_node', true);
            } else {
                view()->share('can_view_node', false);
            }
            if ($setting && $setting->cshap == 1) {
                view()->share('can_view_cshap', true);
            } else {
                view()->share('can_view_cshap', false);
            }
            if ($setting && $setting->java == 1) {
                view()->share('can_view_java', true);
            } else {
                view()->share('can_view_java', false);
            }
            if ($setting && $setting->javascript == 1) {
                view()->share('can_view_javascript', true);
            } else {
                view()->share('can_view_javascript', false);
            }
            if ($setting && $setting->ftp == 1) {
                view()->share('can_view_ftp', true);
            } else {
                view()->share('can_view_ftp', false);
            }
            if ($setting && $setting->ubuntu == 1) {
                view()->share('can_view_ubuntu', true);
            } else {
                view()->share('can_view_ubuntu', false);
            }
            if ($setting && $setting->mysql == 1) {
                view()->share('can_view_mysql', true);
            } else {
                view()->share('can_view_mysql', false);
            }
            if ($setting && $setting->sqlsever == 1) {
                view()->share('can_view_sqlsever', true);
            } else {
                view()->share('can_view_sqlsever', false);
            }
            if ($setting && $setting->mongo == 1) {
                view()->share('can_view_mongo', true);
            } else {
                view()->share('can_view_mongo', false);
            }
            if ($setting && $setting->mysqlworkbench == 1) {
                view()->share('can_view_mysqlworkbench', true);
            } else {
                view()->share('can_view_mysqlworkbench', false);
            }
            if ($setting && $setting->postgreSQL == 1) {
                view()->share('can_view_postgreSQL', true);
            } else {
                view()->share('can_view_postgreSQL', false);
            }
            if ($setting && $setting->error == 1) {
                view()->share('can_view_error', true);
            } else {
                view()->share('can_view_error', false);
            }
           
        } 

        return $next($request);
    }
}
