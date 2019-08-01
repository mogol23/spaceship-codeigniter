<main id="content" class="content" role="main">
    <div class="row">
        <div class="col-lg-12">
            <section class="widget">
                <header>
                    <h4><?= $title ?></h4>
                    <div class="widget-controls">
                        <a data-widgster="fullscreen" title="Full Screen" href="javascript:void(0)"><i class="glyphicon glyphicon-fullscreen"></i></a>
                        <a data-widgster="restore" title="Restore" href="javascript:void(0)"><i class="glyphicon glyphicon-resize-small"></i></a>
                        <a data-widgster="expand" title="Expand" href="javascript:void(0)"><i class="la la-angle-up"></i></a>
                        <a data-widgster="collapse" title="Collapse" href="javascript:void(0)"><i class="la la-angle-down"></i></a>
                    </div>
                </header>
                <div class="widget-body">
                    <form role="form">
                            <fieldset>
                                <legend>
                                    Control sizing
                                </legend>
                                <p>
                                    Set input heights using classes like <code>.form-control-lg</code> and <code>.form-control-sm</code>.
                                    Also works with <code>type="search"</code> inputs and selects. For input groups use
                                    <code>.input-group-lg</code> & <code>.input-group-sm</code>.
                                </p>
                                <br/>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" placeholder=".form-control-lg">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="default input">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" placeholder=".form-control-sm">
                                </div>
                            </fieldset>
                        </form>
                </div>
            </section>
        </div>
    </div>
</main>
