package pl.banhangtichluy.dto.views.v2;

import com.querydsl.core.annotations.QueryProjection;
import lombok.Data;
import lombok.RequiredArgsConstructor;

@Data
@RequiredArgsConstructor
public class AmountBaseView {
    private final Long id;
    private final String type;
    private final String code;
    private final Integer value;
}
