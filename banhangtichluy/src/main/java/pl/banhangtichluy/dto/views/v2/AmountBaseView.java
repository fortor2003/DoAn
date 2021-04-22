package pl.banhangtichluy.dto.views.v2;

import com.querydsl.core.Tuple;
import com.querydsl.core.annotations.QueryProjection;
import com.querydsl.core.types.MappingProjection;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;
import lombok.experimental.SuperBuilder;
import pl.banhangtichluy.entity.QAmount;

@Data
@SuperBuilder
@NoArgsConstructor
public class AmountBaseView {
    private Long id;
    private String type;
    private String code;
    private Integer value;

    private static final QAmount qAmount = QAmount.amount;

    public static final MappingProjection<AmountBaseView> PROJECTIONS = new MappingProjection<AmountBaseView>(
            AmountBaseView.class,
            qAmount.id, qAmount.type, qAmount.code, qAmount.value
    ) {
        @Override
        protected AmountBaseView map(Tuple row) {
            return AmountBaseView.builder()
                    .id(row.get(qAmount.id))
                    .type(row.get(qAmount.type))
                    .code(row.get(qAmount.code))
                    .value(row.get(qAmount.value))
                    .build();
        }
    };
}
