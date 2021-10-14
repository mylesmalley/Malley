<script>
    let options = {
        // no extension
        smartfloor_seat: {
            image: '{{ mix('img/blueprint/seats/smart-seat.png') }}',
            options: [
                'FTM-C004-001', // SMARTFLOOR SEAT
            ],
        },

        smartfloor_turny: {
            image: '{{ mix('img/blueprint/seats/smart-seat.png') }}',
            options: [
                'FTM-C005-001', // SMARTSEAT - EZ M1 TIP AND FOLD TURNY
            ],
        },




        wheelchair_position: {
            image: '{{ mix('img/blueprint/other/wheelchair.png') }}',
            options: [
                'FTM-D003-001', // smartfloor
            ],
        },
        {{--wheelchair_position_snc: {--}}
        {{--    image: '{{ mix('img/blueprint/other/wheelchair.png') }}',--}}
        {{--    options: [--}}
        {{--        'FTM-D001-001', // L-TRACK WHEELCHAIR RESTRAINT SYSTEM--}}
        {{--    ],--}}
        {{--},--}}

        shoulder_harness: {
            image: '{{ mix('img/blueprint/other/shoulder-harness.png') }}',
            options: [
                'FTM-D004-004',
            ],
        },

        {{--seatbelt_extension_8: {--}}
        {{--    image: '{{ mix('img/blueprint/seats/seatbelt-8.png') }}',--}}
        {{--    options: [--}}
        {{--        'FTM-P009-001',--}}
        {{--    ],--}}
        {{--},--}}
        {{--seatbelt_extension_12: {--}}
        {{--    image: '{{ mix('img/blueprint/seats/seatbelt-12.png') }}',--}}
        {{--    options: [--}}
        {{--        'FTM-P010-001',--}}
        {{--    ],--}}
        {{--},--}}
        {{--seatbelt_extension_18: {--}}
        {{--    image: '{{ mix('img/blueprint/seats/seatbelt-18.png') }}',--}}
        {{--    options: [--}}
        {{--        'FTM-P011-001',--}}
        {{--    ],--}}
        {{--},--}}

    };
</script>
