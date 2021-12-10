<div>
    @if( !$labour )
        @includeIf('labour::livewire.manage-labour-components.info')
    @elseif ( $labour && $labour->id )

        <!-- The record is already posted and can't be changed -->
        @if ( $labour->posted === true )
            @includeIf('labour::livewire.manage-labour-components.posted')

        <!-- The record has not yet been posted and can be changed. -->
        @else

            <!-- The user is currently clocked in -->
            @if ( $clocked_in )
                @includeIf('labour::livewire.manage-labour-components.clocked_in')


            <!-- The user is clocked out, so this record can be fully changed. -->
            @else
                @includeIf('labour::livewire.manage-labour-components.clocked_out')

            @endif
            <!-- End of changing records -->

        @endif
        <!-- End of currently active record -->

    @else

        @includeIf('labour::livewire.manage-labour-components.add')
    @endif
    <!-- end of labour record loaded -->
</div>