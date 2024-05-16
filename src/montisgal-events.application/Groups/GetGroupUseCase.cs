using montisgal_events.domain.Groups;

namespace montisgal_events.application.Groups;

public class GetGroupUseCase(IGroupRepository repository)
{
    public async Task<Group?> Execute(Guid id, Guid ownerId)
    {
        return await repository.GetGroup(id, ownerId);
    }
}