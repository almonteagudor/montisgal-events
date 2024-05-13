using montisgal_events.domain.Group;

namespace montisgal_events.application.Groups;

public class DeleteGroupUseCase(IGroupRepository repository)
{
    public async Task<bool> Execute(Guid id, Guid ownerId)
    {
        var group = await repository.GetGroup(id, ownerId);

        if (group is null) return false;

        return await repository.DeleteGroup(group);
    }
}