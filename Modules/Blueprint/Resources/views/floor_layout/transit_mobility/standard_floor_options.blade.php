<script>
    let options = {
        // no extension
        single_fixed_passenger_no_extension: {
            image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
            options: [
                'FTM-P003-001', // FREEDMAN SINGLE SEAT - PASSENGER SIDE - FIX
            ],
        },
        single_folding_passenger_no_extension: {
            image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
            options: [
                'FTM-P007-001', 	//FREEDMAN SINGLE SEAT - PASSENGER SIDE - FOLD
            ],
        },
        double_fixed_passenger_no_extension: {
            image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
            options: [
                'FTM-P004-001', 	// FREEDMAN DOUBLE SEAT - PASSENGER SIDE - FIX
            ],
        },
        double_folding_passenger_no_extension: {
            image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
            options: [
                'FTM-P008-001', // passenger double fold
            ],
        },

        // 8" extension
        single_fixed_passenger_8in_extension: {
            image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
            options: [
                'FTM-P009-001',  // seat belt extension
                'FTM-P003-001', // FREEDMAN SINGLE SEAT - PASSENGER SIDE - FIX
            ],
        },
        single_folding_passenger_8in_extension: {
            image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
            options: [
                'FTM-P009-001', // seat belt extension
                'FTM-P007-001', 	//FREEDMAN SINGLE SEAT - PASSENGER SIDE - FOLD
            ],
        },
        double_fixed_passenger_8in_extension: {
            image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
            options: [
                'FTM-P009-001', // seat belt extension
                'FTM-P004-001', 	// FREEDMAN DOUBLE SEAT - PASSENGER SIDE - FIX
            ],
        },
        double_folding_passenger_8in_extension: {
            image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
            options: [
                'FTM-P009-001', // seat belt extension
                'FTM-P008-001', // passenger double fold
            ],
        },


        // 12 in extension
        single_fixed_passenger_12in_extension: {
            image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
            options: [
                'FTM-P010-001', // seat belt extension
                'FTM-P003-001', // FREEDMAN SINGLE SEAT - PASSENGER SIDE - FIX
            ],
        },
        single_folding_passenger_12in_extension: {
            image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
            options: [
                'FTM-P010-001', // seat belt extension
                'FTM-P007-001', 	//FREEDMAN SINGLE SEAT - PASSENGER SIDE - FOLD
            ],
        },
        double_fixed_passenger_12in_extension: {
            image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
            options: [
                'FTM-P010-001', // seat belt extension
                'FTM-P004-001', 	// FREEDMAN DOUBLE SEAT - PASSENGER SIDE - FIX
            ],
        },
        double_folding_passenger_12in_extension: {
            image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
            options: [
                'FTM-P010-001', // seat belt extension
                'FTM-P008-001', // passenger double fold
            ],
        },


        // 18" extension
        single_fixed_passenger_18in_extension: {
            image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
            options: [
                'FTM-P011-001', // seat belt extension
                'FTM-P003-001', // FREEDMAN SINGLE SEAT - PASSENGER SIDE - FIX
            ],
        },
        single_folding_passenger_18in_extension: {
            image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
            options: [
                'FTM-P011-001', // seat belt extension
                'FTM-P007-001', //FREEDMAN SINGLE SEAT - PASSENGER SIDE - FOLD
            ],
        },
        double_fixed_passenger_18in_extension: {
            image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
            options: [
                'FTM-P011-001', // seat belt extension
                'FTM-P004-001', // FREEDMAN DOUBLE SEAT - PASSENGER SIDE - FIX
            ],
        },
        double_folding_passenger_18in_extension: {
            image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
            options: [
                'FTM-P011-001', // seat belt extension
                'FTM-P008-001', // passenger double fold
            ],
        },


        /*
        * DRIVER SIDE
        * */
        single_fixed_driver_no_extension: {
            image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
            options: [
                'FTM-P001-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
            ],
        },
        single_folding_driver_no_extension: {
            image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
            options: [
                'FTM-P005-001', 	//FREEDMAN SINGLE SEAT - driver SIDE - FOLD
            ],
        },
        double_fixed_driver_no_extension: {
            image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
            options: [
                'FTM-P002-001', // FREEDMAN DOUBLE SEAT - driver SIDE - FIX
            ],
        },
        double_folding_driver_no_extension: {
            image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
            options: [
                'FTM-P006-001', // driver double fold
            ],
        },


        // 8" extension
        single_fixed_driver_8in_extension: {
            image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
            options: [
                'FTM-P001-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                'FTM-P003-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
            ],
        },
        single_folding_driver_8in_extension: {
            image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
            options: [
                'FTM-P009-001', // seat belt extension
                'FTM-P005-001', 	//FREEDMAN SINGLE SEAT - driver SIDE - FOLD
            ],
        },
        double_fixed_driver_8in_extension: {
            image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
            options: [
                'FTM-P009-001', // seat belt extension
                'FTM-P002-001', // FREEDMAN DOUBLE SEAT - driver SIDE - FIX
            ],
        },
        double_folding_driver_8in_extension: {
            image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
            options: [
                'FTM-P009-001', // seat belt extension
                'FTM-P006-001', // driver double fold
            ],
        },


        // 12 in extension
        single_fixed_driver_12in_extension: {
            image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
            options: [
                'FTM-P001-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                'FTM-P003-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
            ],
        },
        single_folding_driver_12in_extension: {
            image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
            options: [
                'FTM-P010-001', // seat belt extension
                'FTM-P005-001', 	//FREEDMAN SINGLE SEAT - driver SIDE - FOLD
            ],
        },
        double_fixed_driver_12in_extension: {
            image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
            options: [
                'FTM-P010-001', // seat belt extension
                'FTM-P002-001', // FREEDMAN DOUBLE SEAT - driver SIDE - FIX
            ],
        },
        double_folding_driver_12in_extension: {
            image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
            options: [
                'FTM-P010-001', // seat belt extension
                'FTM-P006-001', // driver double fold
            ],
        },


        // 18" extension
        single_fixed_driver_18in_extension: {
            image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
            options: [
                'FTM-P001-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                'FTM-P003-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
            ],
        },
        single_folding_driver_18in_extension: {
            image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
            options: [
                'FTM-P011-001', // seat belt extension
                'FTM-P005-001', 	//FREEDMAN SINGLE SEAT - driver SIDE - FOLD
            ],
        },
        double_fixed_driver_18in_extension: {
            image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
            options: [
                'FTM-P011-001', // seat belt extension
                'FTM-P002-001', // FREEDMAN DOUBLE SEAT - driver SIDE - FIX
            ],
        },
        double_folding_driver_18in_extension: {
            image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
            options: [
                'FTM-P011-001', // seat belt extension
                'FTM-P006-001', // driver double fold
            ],
        },







        wheelchair_position: {
            image: '{{ mix('img/blueprint/other/wheelchair.png') }}',
            options: [
                'FTM-D002-001', // L-TRACK WHEELCHAIR RESTRAINT SYSTEM
            ],
        },

        wheelchair_position_snc: {
            image: '{{ mix('img/blueprint/other/wheelchair.png') }}',
            options: [
                'FTM-D001-001', // L-TRACK WHEELCHAIR RESTRAINT SYSTEM
            ],
        },
    };
</script>
