<?php

namespace Modules\Labour\Tests\Feature;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\User;
use App\Models\Labour;


class LabourModelTest extends TestCase
{

    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user =  User::permission('labour_clock_in')->get()->random();
    }


    /** @test  */
    public function user_can_have_labour()
    {
        $this->assertGreaterThanOrEqual( 0,  $this->user->labour()->count() );
    }

    /** @test  */
    public function add_time_to_new_user()
    {
        User::factory(1 )->malley()->create();
        $new = User::orderBy('id','DESC')->first();
        $this->assertEquals( 0, $new->labour()->count() );
        $new->labour()->save(new Labour([
            'job'=> 'ABC123',
            'start' => Carbon::now()->subHours(2),
            'end' => Carbon::now(),
        ]));
        $this->assertEquals( 1, $new->labour()->count() );
    }


    /** @test  */
    public function can_have_only_one_active_labour()
    {
        $user =  User::permission('labour_clock_in')->get()->random();

        $count = DB::table('labour')
            ->where('user_id',$user->id )
            ->whereNull('end')
            ->get()
            ->count();

        $this->assertLessThanOrEqual( 1 , $count);


    }

    /** @test  */
    public function can_add_time_when_clocked_out()
    {
        $state = $this->user->activeLabour();
        if ($state !== null)
        {
            $this->user->activeLabour()->finish();
        }

        $l = new Labour([
            'user_id' => $this->user->id,
            'job' => 'xxx',
            'start' => Carbon::now(),
            'end' => null,
        ]);
//        dd( $l );

        $this->assertTrue( $l->save() );

    }

    /** @test  */
    public function cannot_add_new_time_when_clocked_in()
    {
        $state = $this->user->activeLabour();
//    dd( $state );
        if ( $state === null )
        {
            $l = new Labour([
                'user_id' => $this->user->id,
                'job' => 'xxx',
                'start' => Carbon::now(),
                'end' => null,
            ]);
            $l->save();
        }

        $l2 = new Labour([
            'user_id' => $this->user->id,
            'job' => 'xxx',
            'start' => Carbon::now(),
            'end' => null,
        ]);

        $this->assertFalse( $l2->save() );
    }


}
