package pl.banhangtichluy.dto.views.v2;

import com.querydsl.core.Tuple;
import com.querydsl.core.types.MappingProjection;
import lombok.Data;
import lombok.NoArgsConstructor;
import lombok.experimental.SuperBuilder;
import pl.banhangtichluy.entity.QTransaction;

import java.util.Date;

@Data
@SuperBuilder
@NoArgsConstructor
public class TransactionView extends TransactionBaseView {

    private String note;
    private Date createdAt;
    private Date updatedAt;
    private AmountBaseView amount;
    private UserBaseView createdBy;
    private UserBaseView updatedBy;


    private static final QTransaction qTransaction = QTransaction.transaction;

    public static final MappingProjection<TransactionView> PROJECTIONS = new MappingProjection<TransactionView>(
            TransactionView.class,
            qTransaction.id, qTransaction.code, qTransaction.beforeValue, qTransaction.afterValue, qTransaction.note, qTransaction.createdAt, qTransaction.updatedAt,
            qTransaction.amount.id, qTransaction.amount.type, qTransaction.amount.code, qTransaction.amount.value,
            qTransaction.createdBy.id, qTransaction.createdBy.username, qTransaction.createdBy.firstName, qTransaction.createdBy.lastName,
            qTransaction.updatedBy.id, qTransaction.updatedBy.username, qTransaction.updatedBy.firstName, qTransaction.updatedBy.lastName
    ) {
        @Override
        protected TransactionView map(Tuple row) {
            return TransactionView.builder()
                    .id(row.get(qTransaction.id))
                    .code(row.get(qTransaction.code))
                    .beforeValue(row.get(qTransaction.beforeValue))
                    .afterValue(row.get(qTransaction.afterValue))
                    .note(row.get(qTransaction.note))
                    .createdAt(row.get(qTransaction.createdAt))
                    .updatedAt(row.get(qTransaction.updatedAt))
                    .amount(
                            row.get(qTransaction.amount.id) != null
                                    ? AmountBaseView.builder()
                                    .id(row.get(qTransaction.amount.id))
                                    .type(row.get(qTransaction.amount.type))
                                    .code(row.get(qTransaction.amount.code))
                                    .value(row.get(qTransaction.amount.value))
                                    .build()
                                    : null
                    )
                    .createdBy(
                            row.get(qTransaction.createdBy.id) != null
                                    ? UserBaseView.builder()
                                    .id(row.get(qTransaction.createdBy.id))
                                    .username(row.get(qTransaction.createdBy.username))
                                    .firstName(row.get(qTransaction.createdBy.firstName))
                                    .lastName(row.get(qTransaction.createdBy.lastName))
                                    .build()
                                    : null
                    )
                    .updatedBy(
                            row.get(qTransaction.updatedBy.id) != null
                                    ? UserBaseView.builder()
                                    .id(row.get(qTransaction.updatedBy.id))
                                    .username(row.get(qTransaction.updatedBy.username))
                                    .firstName(row.get(qTransaction.updatedBy.firstName))
                                    .lastName(row.get(qTransaction.updatedBy.lastName))
                                    .build()
                                    : null
                    )
                    .build();
        }
    };
}
