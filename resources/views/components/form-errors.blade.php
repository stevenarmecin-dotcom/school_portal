@if ($errors->any())
    <div role="alert" style="
        display: flex;
        gap: 12px;
        align-items: flex-start;
        background: #fff1f2;
        border: 1px solid #fecdd3;
        border-left: 5px solid #e11d48;
        border-radius: 10px;
        padding: 14px 16px;
        margin-bottom: 16px;
        font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
        box-shadow: 0 2px 8px rgba(225, 29, 72, 0.12);
    ">
        <div style="
            flex-shrink: 0;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #e11d48;
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            line-height: 24px;
            text-align: center;
        ">!</div>

        <div style="flex: 1;">
            <div style="font-size: 15px; font-weight: 600; color: #9f1239; margin-bottom: 6px;">
                Please fix the following errors
            </div>

            <ul style="margin: 0; padding-left: 18px; font-size: 14px; color: #be123c; line-height: 1.6;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
