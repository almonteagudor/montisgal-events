using montisgal_events.domain.Group;

namespace montisgal_events.application.Groups;

public class GetGroupsUseCase(IGroupRepository repository)
{
    public async Task<List<Group>> Execute(Guid ownerId)
    {
        return await repository.GetGroups(ownerId);
    }
}