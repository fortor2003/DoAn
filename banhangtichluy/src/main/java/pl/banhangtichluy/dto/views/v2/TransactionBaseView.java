package pl.banhangtichluy.dto.views.v2;

import com.querydsl.core.Tuple;
import com.querydsl.core.types.MappingProjection;
import lombok.Data;
import lombok.NoArgsConstructor;
import lombok.experimental.SuperBuilder;
import pl.banhangtichluy.entity.QAmount;
import pl.banhangtichluy.entity.QTransaction;

@Data
@SuperBuilder
@NoArgsConstructor
public class TransactionBaseView {
    private Long id;
    private String code;
    private Integer beforeValue;
    private Integer afterValue;

    private static final QTransaction qTransaction = QTransaction.transaction;

    public static final MappingProjection<TransactionBaseView> PROJECTIONS = new MappingProjection<TransactionBaseView>(
            TransactionBaseView.class,
            qTransaction.id, qTransaction.code, qTransaction.beforeValue, qTransaction.afterValue
    ) {
        @Override
        protected TransactionBaseView map(Tuple row) {
            return TransactionBaseView.builder()
                    .id(row.get(qTransaction.id))
                    .code(row.get(qTransaction.code))
                    .beforeValue(row.get(qTransaction.beforeValue))
                    .afterValue(row.get(qTransaction.afterValue))
                    .build();
        }
    };
}
